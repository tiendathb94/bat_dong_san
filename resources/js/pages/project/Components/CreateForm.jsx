import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import CategoryField from '../../../containers/category_field'
import { Editor } from 'react-draft-wysiwyg'
import { convertToRaw, EditorState } from 'draft-js'
import TabManager from "./tab_manager"
import axios from 'axios'
import config from "../../../config"
import draftToHtml from "draftjs-to-html"
import { cloneDeep } from 'lodash'
import AutocompleteField from "../../../containers/autocomplete_field"

class CreateForm extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                project_overview: EditorState.createEmpty(),
            }
        }

        this.tabManager = React.createRef()
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

    onClickSaveProjectButton = async () => {
        const values = cloneDeep(this.state.formValues)
        values.project_overview = draftToHtml(convertToRaw(this.state.formValues.project_overview.getCurrentContent()))
        values.tab_contents = this.tabManager.current.getTabContentsFormRawValues()

        const response = await axios.post(`${config.api.baseUrl}/project/create`, values)
        console.log(response)
    }

    onChangeInvestor = (investorId) => {
        console.log(investorId)
    }

    render () {
        return (
            <div>
                <div>
                    <div className="container">
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
                                    className="form-control"
                                />
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
                                />
                            </div>
                        </div>

                        <div className="row">
                            <div className="form-group col col-sm-12 col-md-6">
                                <label>Tổng diện tích</label>
                                <div className="input-group">
                                    <input
                                        name="total_area"
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
                                    className="form-control"
                                >
                                    <option>-- Chọn đơn vị giá --</option>
                                    <option value="1">Triệu</option>
                                    <option value="2">Tỷ</option>
                                    <option value="3">Trăm nghìn/m2</option>
                                    <option value="4">Triệu/m2</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <AddressForm onSync={this.onSyncAddress}/>

                    <div className="container">
                        <div className="row">
                            <div className="col">
                                <label>Chủ đầu tư</label>
                                <AutocompleteField
                                    endpoint="investor/autocomplete-field-search"
                                    onChange={this.onChangeInvestor}
                                />
                            </div>
                        </div>

                        <div className="row">
                            <div className="col">
                                <label>Giới thiệu dự án</label>
                                <Editor
                                    editorState={this.state.formValues.project_overview}
                                    onEditorStateChange={this.onProjectOverviewChange}
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div className="container mt-3">
                    <div className="row">
                        <div className="col">
                            <h3>Nội dung nâng cao</h3>
                            <TabManager ref={this.tabManager}/>
                        </div>
                    </div>

                    <div className="row mt-3">
                        <div className="col">
                            <button
                                className="btn btn-primary btn-save-project"
                                onClick={this.onClickSaveProjectButton}
                            >
                                Lưu dự án
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default CreateForm
