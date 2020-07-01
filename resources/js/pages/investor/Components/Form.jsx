import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import { Editor } from "react-draft-wysiwyg"
import { convertToRaw, EditorState } from "draft-js"
import classnames from "classnames"
import PropTypes from 'prop-types'
import draftToHtml from "draftjs-to-html"
import axios from "axios"
import config from "../../../config"
import { stateFromHTML } from "draft-js-import-html"

class Form extends Component {
    constructor (props) {
        super(props)
        this.isEditMode = this.props.investor && this.props.investor.id > 0

        this.state = {
            formValues: {
                overview: EditorState.createEmpty(),
                ...this.prepareFormValues(),
            },
            errorByFields: {},
            errors: [],
            loading: false
        }

        this.addressField = React.createRef()
    }

    prepareFormValues () {
        if (!this.isEditMode) {
            return {}
        }

        const address = this.props.investor.address || {}

        return {
            name: this.props.investor.name,
            phone: this.props.investor.phone,
            email: this.props.investor.email,
            website: this.props.investor.website,
            overview: EditorState.createWithContent(stateFromHTML(this.props.investor.overview)),
            address: {
                province_id: address.province_id,
                district_id: address.district_id,
                ward_id: address.ward_id,
                address: address.address,
            }
        }
    }

    setFormFieldValue = (event) => {
        if (event.target.name === 'logo') {
            this.setState({ formValues: { ...this.state.formValues, [event.target.name]: event.target.files.item(0) } })
        } else {
            this.setState({ formValues: { ...this.state.formValues, [event.target.name]: event.target.value } })
        }
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

    onInvestorOverviewChange = (editorState) => {
        this.setState({ formValues: { ...this.state.formValues, overview: editorState } })
    }

    validate () {
        const errorByFields = {}
        const requiredFields = ['name', 'phone', 'email', 'website', 'overview', 'logo']
        for (let i = 0; i < requiredFields.length; i++) {
            const fieldName = requiredFields[i]
            if (fieldName === 'overview' && !this.state.formValues[fieldName].getCurrentContent().hasText()) {
                errorByFields[fieldName] = 'Bạn không được bỏ trống trường này'
            } else if (!this.state.formValues[fieldName]) {
                if (fieldName === 'logo' && this.isEditMode) {
                    // No require update logo on edit mode
                    continue
                }

                errorByFields[fieldName] = 'Bạn không được bỏ trống trường này'
            }
        }

        this.setState({ errorByFields })

        const addressValid = this.addressField.current.validate()
        return Object.keys(errorByFields).length < 1 && addressValid
    }

    onClickSubmit = async () => {
        if (!this.validate()) {
            return
        }

        this.setState({ loading: true })

        try {
            const formData = new FormData()
            for (const k in this.state.formValues) {
                if (k === 'overview') {
                    formData.append('overview', draftToHtml(convertToRaw(this.state.formValues.overview.getCurrentContent())))
                } else if (k === 'address') {
                    for (const ak in this.state.formValues.address) {
                        formData.set(`address[${ak}]`, this.state.formValues.address[ak])
                    }
                } else {
                    formData.append(k, this.state.formValues[k])
                }
            }

            if (this.isEditMode) {
                await axios.post(`${config.api.baseUrl}/investor/update/${this.props.investor.id}`, formData, {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
            } else {
                await axios.post(`${config.api.baseUrl}/investor/create`, formData, {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
            }

            window.location = '/investor/posted'
        } catch (e) {
            window.scrollTo(0, 0)
            if (e.response && e.response.data) {
                if (e.response.data.errors) {
                    const errorByFields = {}
                    for (const k in e.response.data.errors) {
                        errorByFields[k] = e.response.data.errors[k][0]
                    }

                    this.setState({ errorByFields })
                } else {
                    this.setState({ errors: [e.response.data.message || 'Đã có lỗi sảy ra vui lòng thử lại'] })
                }
            }
        }

        this.setState({ loading: false })
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
                    this.state.errors.length > 0 &&
                    <div className="container">
                        <div className="row">
                            <div className="col alert alert-danger" role="alert">
                                <ul className="mb-0">
                                    {this.state.errors.map((err) => <li key={err}>{err}</li>)}
                                </ul>
                            </div>
                        </div>
                    </div>
                }

                <div className="row">
                    <div className="col form-group">
                        <label>Tên công ty/doanh nghiệp</label>
                        <input
                            className={classnames({
                                'form-control': true,
                                'is-invalid': !!this.state.errorByFields.name
                            })}
                            name="name"
                            placeholder="Nhập tên công ty/doanh nghiệp"
                            value={this.state.formValues.name || ''}
                            onChange={this.setFormFieldValue}
                        />
                        {this.renderFieldError('name')}
                    </div>
                </div>

                <div className="row">
                    <div className="col form-group col-sm-12 col-md-6">
                        <label>Website</label>
                        <input
                            className={classnames({
                                'form-control': true,
                                'is-invalid': !!this.state.errorByFields.website
                            })}
                            name="website"
                            value={this.state.formValues.website || ''}
                            placeholder="Nhập địa chỉ website"
                            onChange={this.setFormFieldValue}
                        />
                        {this.renderFieldError('website')}
                    </div>
                    <div className="col form-group col-sm-12 col-md-6">
                        <label>Logo</label>
                        <div className="input-group">
                            <input
                                type="file"
                                className={classnames({
                                    'custom-file-input': true,
                                    'is-invalid': !!this.state.errorByFields.logo
                                })}
                                name="logo"
                                onChange={this.setFormFieldValue}
                            />
                            <label className="custom-file-label" htmlFor="inputGroupFile01">
                                {
                                    this.state.formValues.logo ?
                                        this.state.formValues.logo.name :
                                        this.isEditMode ? this.props.investor.logo : 'Chọn ảnh logo'
                                }
                            </label>
                            {
                                this.isEditMode && this.props.investor.logo &&
                                <span className="text-muted small">
                                    Xem logo đã tải <a href={`/storage/${this.props.investor.logo}`} target="_blank">bấm vào đây</a>
                                </span>
                            }
                        </div>
                        {this.renderFieldError('logo')}
                    </div>
                </div>

                <div className="row">
                    <div className="col form-group col-sm-12 col-md-6">
                        <label>Điện thoại liên hệ</label>
                        <input
                            className={classnames({
                                'form-control': true,
                                'is-invalid': !!this.state.errorByFields.phone
                            })}
                            value={this.state.formValues.phone || ''}
                            name="phone"
                            type="phone"
                            placeholder="Nhập số điện thoại"
                            onChange={this.setFormFieldValue}
                        />
                        {this.renderFieldError('phone')}
                    </div>
                    <div className="col form-group col-sm-12 col-md-6">
                        <label>Địa chỉ email</label>
                        <input
                            className={classnames({
                                'form-control': true,
                                'is-invalid': !!this.state.errorByFields.email
                            })}
                            value={this.state.formValues.email || ''}
                            name="email"
                            type="email"
                            placeholder="Nhập địa chỉ email"
                            onChange={this.setFormFieldValue}
                        />
                        {this.renderFieldError('email')}
                    </div>
                </div>

                <AddressForm
                    onSync={this.onSyncAddress}
                    required={true}
                    ref={this.addressField}
                    wardId={this.state.formValues.address.ward_id}
                    provinceId={this.state.formValues.address.province_id}
                    districtId={this.state.formValues.address.district_id}
                    line={this.state.formValues.address.address}
                />

                <div className="row">
                    <div className="col">
                        <label>Giới thiệu</label>
                        <Editor
                            editorState={this.state.formValues.overview}
                            onEditorStateChange={this.onInvestorOverviewChange}/>
                        {this.renderFieldError('overview')}
                    </div>
                </div>

                <div className="row mt-3">
                    <div className="col text-right">
                        <button
                            className="btn btn-primary pl-5 pr-5"
                            onClick={this.onClickSubmit}
                            disabled={this.state.loading}
                        >
                            {this.state.loading ? 'Đang lưu vui lòng đợi...' : 'Lưu lại'}
                        </button>
                    </div>
                </div>
            </div>
        )
    }
}

Form.propTypes = {
    investor: PropTypes.object
}

export default Form
