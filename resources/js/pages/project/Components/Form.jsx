import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import CategoryField from '../../../containers/category_field'
import { Editor } from 'react-draft-wysiwyg'
import { convertToRaw, EditorState } from 'draft-js'
import { stateFromHTML } from 'draft-js-import-html'
import TabManager from "./tab_manager"
import axios from 'axios'
import config from "../../../config"
import draftToHtml from "draftjs-to-html"
import { cloneDeep } from 'lodash'
import AutocompleteField from "../../../containers/autocomplete_field"
import ImageLibraryUpload from "../../../containers/image_ library_upload"
import classnames from "classnames"
import PropTypes from 'prop-types'

class Form extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                project_overview: EditorState.createEmpty(),
                ...this.initFormValuesForEditExistProject(props.project),
            },
            errors: [],
            errorByFields: {},
            loading: false
        }

        this.tabManager = React.createRef()
        this.imageLibraryUpload = React.createRef()
        this.addressField = React.createRef()
        this.isEditMode = props.project && props.project.id > 0
    }

    initFormValuesForEditExistProject (existProject) {
        if (!existProject) {
            return {}
        }

        return {
            long_name: existProject.long_name,
            short_name: existProject.short_name,
            category_id: existProject.category_id,
            total_area: existProject.total_area,
            project_scale: existProject.project_scale,
            price: existProject.price,
            price_unit: existProject.price_unit,
            address: existProject.address || {},
            investor_type: existProject.investor_type || '',
            project_overview: EditorState.createWithContent(stateFromHTML(existProject.project_overview)),
            tab_contents: this.parseExistTabContent(existProject.tabs)
        }
    }

    parseExistTabContent (existTabContents) {
        const tabContents = []

        for (let i = 0; i < existTabContents.length; i++) {
            tabContents.push({
                name: existTabContents[i].name,
                id: existTabContents[i].id,
                layout: existTabContents[i].template,
                ...existTabContents[i].contents
            })
        }

        return tabContents
    }

    onSyncAddress = (address) => {
        this.setState({
            formValues: {
                ...this.state.formValues,
                address: {
                    province_id: address.provinceId,
                    district_id: address.districtId,
                    ward_id: address.wardId,
                    address: address.line,
                }
            }
        })
    }

    onChangeCategory = (event) => {
        this.setState({ formValues: { ...this.state.formValues, category_id: event.target.value } })
    }

    onProjectOverviewChange = (editorState) => {
        this.setState({ formValues: { ...this.state.formValues, project_overview: editorState } })
    }

    setFormFieldValue = (event) => {
        this.setState({ formValues: { ...this.state.formValues, [event.target.name]: event.target.value } })
    }

    async doUpload (libraryableType, libraryableId, libraryType, metaData = [], selectedFiles = []) {
        if (!selectedFiles || !selectedFiles.length) {
            return
        }

        const formData = new FormData()
        formData.append('libraryable_type', libraryableType)
        formData.append('libraryable_id', libraryableId)
        formData.append('library_type', libraryType)

        for (let i = 0; i < selectedFiles.length; i++) {
            formData.set(`files[${i}]`, selectedFiles[i])
        }

        for (const k in metaData) {
            formData.append(`meta_data[${k}]`, metaData[k])
        }

        const response = await axios.post(
            `${config.api.baseUrl}/image-library/uploads`,
            formData,
            {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            },
        )

        return response.data
    }

    async deleteUploadedLibraries (ids) {
        if (!ids || ids.length < 1) {
            return
        }

        try {
            await axios.post(`${config.api.baseUrl}/image-library/deletes`, {
                image_library_ids: ids
            })
        } catch (e) {
            console.error(e)
        }
    }



    onClickSaveProjectButton = async () => {
        
        // var times = $('.datepicker').val().split('/');
        var times = ["2021","01","05"];
        var date_upload_file = times[2] + '-' + times[1] + '-' + times[0];
        var date_sort = date_upload_file.replace(/-/g, '')

        if (!this.validate()) {
            window.scrollTo(0, 0)
            return
        }

        const values = cloneDeep(this.state.formValues)
        values.project_overview = draftToHtml(convertToRaw(this.state.formValues.project_overview.getCurrentContent()))
        values.tab_contents = this.tabManager.current.getTabContentsFormRawValues()
        try {
            this.setState({ loading: true })

            // Create project
            if (this.isEditMode) {
                await axios.put(`${config.api.baseUrl}/project/${this.props.project.id}`, values)

                // Upload progress images
                await values.tab_contents.map((tab) => {
                    if(tab.layout == 'project_progress') {
                        this.deleteUploadedLibraries(tab.contents.removeFileIds)
                        this.doUpload(
                            'App\\Entities\\Project',
                            this.props.project.id,
                            'progress',
                            {
                                date_upload_file: date_upload_file,
                                date_sort: date_sort
                            },
                            tab.contents.progressImageFiles
                        )
                    }
                })

                // Upload library images
                await this.imageLibraryUpload.current.doUpload(
                    'App\\Entities\\Project',
                    this.props.project.id,
                    'gallery',
                )
            } else {
                const createProjectResponse = await axios.post(`${config.api.baseUrl}/project/create`, values)
                const createdProject = createProjectResponse.data

                // Upload progress images
                await values.tab_contents.map((tab) => {
                    if(tab.layout == 'project_progress') {
                        this.deleteUploadedLibraries(tab.contents.removeFileIds)
                        this.doUpload(
                            'App\\Entities\\Project',
                            createdProject.id,
                            'progress',
                            {
                                date_upload_file: date_upload_file,
                                date_sort: date_sort
                            },
                            tab.contents.progressImageFiles
                        )
                    }
                })

                // Upload library images
                await this.imageLibraryUpload.current.doUpload(
                    'App\\Entities\\Project',
                    createdProject.id,
                    'gallery',
                )
            }

            // Redirect to posted project
            window.location = '/project/posted'
        } catch (e) {
            if (e.response && e.response.data) {
                window.scrollTo(0, 0)
                if (e.response.data.errors) {
                    const stateErrors = []
                    const errors = Object.values(e.response.data.errors)
                    for (let i = 0; i < errors.length; i++) {
                        stateErrors.push(errors[i].join(' '))
                    }
                    this.setState({ errors: stateErrors })
                } else {
                    this.setState({ errors: [e.response.data.message || 'Đã có lỗi sảy ra vui lòng thử lại'] })
                }
            }
        }

        this.setState({ loading: false})
    }

    getAddressValue (fieldName) {
        return this.state.formValues.address && this.state.formValues.address[fieldName] ?
            this.state.formValues.address[fieldName] : null
    }

    validate () {
        const errorByFields = {}

        // Validate required fields
        const requiredFields = ['long_name', 'category_id', 'project_overview']
        for (let i = 0; i < requiredFields.length; i++) {
            const fieldName = requiredFields[i]
            if (fieldName === 'project_overview' && !this.state.formValues[fieldName].getCurrentContent().hasText()) {
                errorByFields[fieldName] = 'Bạn không được bỏ trống trường này'
            } else if (!this.state.formValues[fieldName]) {
                errorByFields[fieldName] = 'Bạn không được bỏ trống trường này'
            }
        }

        // Validate investor
        if (this.state.formValues.investor_id && !this.state.formValues.investor_type) {
            errorByFields.investor_type = 'Bạn không được bỏ trống trường này'
        }

        // Validate price unit
        if (this.state.formValues.price && !this.state.formValues.price_unit) {
            errorByFields.price_unit = 'Bạn không được bỏ trống trường này'
        }

        this.setState({ errorByFields })
        const addressValid = this.addressField.current.validate()

        return Object.keys(errorByFields).length < 1 && addressValid
    }

    onChangeInvestor = (investorId, investorName) => {
        this.setState({ formValues: { ...this.state.formValues, investor_id: investorId } })
    }

    renderFieldError (fieldName) {
        if (!this.state.errorByFields[fieldName]) {
            return ''
        }

        return <div className="text-danger form-text">{this.state.errorByFields[fieldName]}</div>
    }

    render () {
        return (
            <div>
                {
                    this.state.errors.length > 0 && <div className="row">
                        <div className="col alert alert-danger" role="alert">
                            <ul className="mb-0">
                                {this.state.errors.map((err) => <li key={err}>{err}</li>)}
                            </ul>
                        </div>
                    </div>
                }

                <div className="row">
                    <div className="col">
                        <h3>Thông tin cơ bản</h3>
                    </div>
                </div>
                <div className="row">
                    <div className="form-group col">
                        <label>Tên dự án</label>
                        <input
                            name="long_name"
                            value={this.state.formValues.long_name || ''}
                            onChange={this.setFormFieldValue}
                            placeholder="Nhập tên dự án"
                            className={classnames({
                                'form-control': true,
                                'is-invalid': !!this.state.errorByFields.long_name
                            })}
                        />
                        {this.renderFieldError('long_name')}
                    </div>
                </div>

                <div className="row">
                    <div className="form-group col col-sm-12 col-md-6">
                        <label>Tên ngắn của dự án</label>
                        <input
                            name="short_name"
                            value={this.state.formValues.short_name || ''}
                            onChange={this.setFormFieldValue}
                            placeholder="Nhập tên ngắn của dự án"
                            className="form-control"
                        />
                    </div>

                    <div className="col col-sm-12 col-md-6">
                        <CategoryField
                            label="Loại hình phát triển"
                            destinationEntity="App\Entities\Project"
                            onChange={this.onChangeCategory}
                            message={this.state.errorByFields.category_id}
                            value={parseInt(this.state.formValues.category_id)}
                        />
                    </div>
                </div>

                <div className="row">
                    <div className="form-group col col-sm-12 col-md-6">
                        <label>Tổng diện tích</label>
                        <div className="input-group">
                            <input
                                name="total_area"
                                type="number"
                                value={this.state.formValues.total_area || ''}
                                onChange={this.setFormFieldValue}
                                placeholder="Tổng diện tích dự án"
                                className="form-control"
                            />
                            <div className="input-group-append">
                                <span className="input-group-text">m<sup>2</sup></span>
                            </div>
                        </div>
                    </div>
                    <div className="col form-group col-sm-12 col-md-6">
                        <label>Quy mô dự án</label>
                        <input
                            name="project_scale"
                            value={this.state.formValues.project_scale || ''}
                            onChange={this.setFormFieldValue}
                            placeholder="Mô tả quy mô dự án"
                            className="form-control"
                        />
                    </div>
                </div>

                <div className="row">
                    <div className="form-group col col-sm-12 col-md-6">
                        <label>Giá</label>
                        <input
                            name="price"
                            type="number"
                            value={this.state.formValues.price || ''}
                            onChange={this.setFormFieldValue}
                            placeholder="Nhập giá của dự án"
                            className="form-control"
                        />
                    </div>
                    <div className="col form-group col-sm-12 col-md-6">
                        <label>Đơn vị giá</label>
                        <select
                            value={this.state.formValues.price_unit || ''}
                            name="price_unit"
                            onChange={this.setFormFieldValue}
                            className={classnames({
                                'form-control': true,
                                'is-invalid': !!this.state.errorByFields.price_unit
                            })}
                        >
                            <option>-- Chọn đơn vị giá --</option>
                            <option value="1">Triệu</option>
                            <option value="2">Tỷ</option>
                            <option value="3">Trăm nghìn/m2</option>
                            <option value="4">Triệu/m2</option>
                        </select>
                        {this.renderFieldError('price_unit')}
                    </div>
                </div>

                <AddressForm
                    onSync={this.onSyncAddress}
                    ref={this.addressField}
                    required={true}
                    districtId={this.getAddressValue('district_id')}
                    provinceId={this.getAddressValue('province_id')}
                    wardId={this.getAddressValue('ward_id')}
                    line={this.getAddressValue('address')}
                />

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label>Chủ đầu tư</label>
                        <AutocompleteField
                            endpoint="investor/autocomplete-field-search"
                            onChange={this.onChangeInvestor}
                            placeholder="Nhập tên của chủ đầu tư để tìm kiếm"
                            selectedItem={
                                this.props.project && this.props.project.investor ? {
                                    value: this.props.project.investor.id,
                                    name: this.props.project.investor.name
                                } : {}
                            }
                        />
                    </div>
                    <div className="col col-sm-12 col-md-6 form-group">
                        <label>Vai trò</label>
                        <select
                            name="investor_type"
                            value={this.state.formValues.investor_type}
                            className={classnames({ 'form-control': true, 'is-invalid': !!this.state.message })}
                            onChange={this.setFormFieldValue}
                        >
                            <option>-- Vai trò --</option>
                            <option value={1}>Chủ đầu tư</option>
                            <option value={2}>Nhà phân phối</option>
                        </select>
                        {this.renderFieldError('investor_type')}
                    </div>
                </div>

                <div className="row">
                    <div className="col">
                        <label>Giới thiệu dự án</label>
                        <Editor
                            editorState={this.state.formValues.project_overview}
                            onEditorStateChange={this.onProjectOverviewChange}
                        />
                        {this.renderFieldError('project_overview')}
                    </div>
                </div>

                <div className="row mt-2">
                    <div className="col">
                        <h3>Tải lên hình ảnh của dự án</h3>
                        <ImageLibraryUpload ref={this.imageLibraryUpload} uploadedImages={
                            this.props.project && this.props.project.galleryImages ? this.props.project.galleryImages : []
                        }/>
                    </div>
                </div>

                <div className="row mt-2">
                    <div className="col">
                        <h3>Nội dung nâng cao</h3>
                    </div>
                </div>

                <div className="row">
                    <div className="col">
                        <TabManager ref={this.tabManager} project={this.props.project} tabContents={this.state.formValues.tab_contents}/>
                    </div>
                </div>

                <div className="row mt-3">
                    <div className="col">
                        <button
                            className="btn btn-primary btn-save-project"
                            onClick={this.onClickSaveProjectButton}
                            disabled={this.state.loading}
                        >
                            {this.state.loading ? 'Đang lưu...' : 'Lưu dự án'}
                        </button>
                    </div>
                </div>
            </div>
        )
    }
}

Form.propTypes = {
    project: PropTypes.object
}

export default Form
