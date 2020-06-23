import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import CategoryField from '../../../containers/category_field'
import { Editor } from 'react-draft-wysiwyg'

class CreateForm extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {}
        }
    }

    onSyncAddress = (address) => {
        this.setState({ formValues: { ...this.state.formValues, address: address } })
    }

    onChangeCategory = (event) => {
        this.setState({ formValues: { ...this.state.formValues, category: event.target.value } })
    }

    setFormFieldValue = (event) => {
        this.setState({ formValues: { ...this.state.formValues, [event.target.name]: event.target.value } })
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
                                    value={this.state.formValues.long_name}
                                    onChange={this.setFormFieldValue}
                                    placeholder="Nhập tên dự án"
                                    className="form-control"
                                />
                            </div>
                        </div>

                        <div className="row">
                            <div className="form-group col">
                                <label>Tên ngắn của dự án</label>
                                <input
                                    name="short_name"
                                    value={this.state.formValues.short_name}
                                    onChange={this.setFormFieldValue}
                                    placeholder="Nhập tên ngắn của dự án"
                                    className="form-control"
                                />
                            </div>

                            <div className="form-group col">
                                <label>Quy mô dự án</label>
                                <input
                                    name="project_scale"
                                    value={this.state.formValues.project_scale}
                                    onChange={this.setFormFieldValue}
                                    placeholder="Mô tả quy mô dự án"
                                    className="form-control"
                                />
                            </div>
                        </div>

                        <div className="row">
                            <div className="col">
                                <CategoryField
                                    label="Loại hình phát triển"
                                    destinationEntity="App\Entities\Project"
                                    onChange={this.onChangeCategory}
                                />
                            </div>
                        </div>
                    </div>

                    <AddressForm onSync={this.onSyncAddress}/>

                    <div className="container">
                        <div className="row">
                            <div className="col">
                                <label>Giới thiệu dự án</label>
                                <Editor/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default CreateForm
