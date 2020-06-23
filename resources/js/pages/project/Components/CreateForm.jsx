import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"

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

    setFormFieldValue = (event) => {
        this.setState({ formValues: { ...this.state.formValues, [event.target.name]: event.target.value } })
    }

    render () {
        return (
            <div>
                <div className="container">
                    <div className="row">
                        <div className="form-group col">
                            <label>Tên dự án</label>
                            <input
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
                                value={this.state.formValues.short_name}
                                onChange={this.setFormFieldValue}
                                placeholder="Nhập tên ngắn của dự án"
                                className="form-control"
                            />
                        </div>

                        <div className="form-group col">
                            <label>Quy mô dự án</label>
                            <input
                                value={this.state.formValues.project_scale}
                                onChange={this.setFormFieldValue}
                                placeholder="Mô tả quy mô dự án"
                                className="form-control"
                            />
                        </div>
                    </div>
                </div>

                <AddressForm onSync={this.onSyncAddress}/>
            </div>
        )
    }
}

export default CreateForm
