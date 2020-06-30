import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import { Editor } from "react-draft-wysiwyg"
import { EditorState } from "draft-js"
import classnames from "classnames"

class Form extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                overview: EditorState.createEmpty()
            },
            errorByFields: {}
        }

        this.addressField = React.createRef()
    }

    setFormFieldValue = (event) => {
        if (event.target.name === 'logo') {
            debugger
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
                errorByFields[fieldName] = 'Bạn không được bỏ trống trường này'
            }
        }

        this.setState({ errorByFields })

        const addressValid = this.addressField.current.validate()
        return Object.keys(errorByFields).length < 1 && addressValid
    }

    onClickSubmit = (event) => {
        if (!this.validate()) {
            return
        }
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
                            value={this.state.formValues.name}
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
                            value={this.state.formValues.website}
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
                                {this.state.formValues.logo ? this.state.formValues.logo.name : 'Chọn ảnh logo'}
                            </label>
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
                            value={this.state.formValues.phone}
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
                            value={this.state.formValues.email}
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
                        <button className="btn btn-primary pl-5 pr-5" onClick={this.onClickSubmit}>Lưu lại</button>
                    </div>
                </div>
            </div>
        )
    }
}

export default Form
