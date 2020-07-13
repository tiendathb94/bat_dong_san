import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"

const FORM_FIELD = {
    1: 'Nhà đất bán',
    2: 'Nhà đát cho thuê'
}
class Form extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {}
        }

        this.addressField = React.createRef()
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

    getAddressValue (fieldName) {
        return this.state.formValues.address && this.state.formValues.address[fieldName] ?
            this.state.formValues.address[fieldName] : null
    }

    onChangeCategory = (event) => {
        this.setState({ formValues: { ...this.state.formValues, category_id: event.target.value } })
    }

    render () {
        return (
            <div>
                <div className="row">
                    <div className="col col-sm-12">
                        <label htmlFor="title">Tiêu đề</label>
                        <input type="text" className="form-control" id="title"/>
                    </div>
                </div>
                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="form">Hình thức</label>
                        <select className="form-control" id="form">
                            <option value="">-- Hình thức --</option>
                            {
                                FORM_FIELD.map((index, value) => (<option value={index}>{value}</option>))
                            }
                        </select>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <CategoryField
                            label="Loại"
                            destinationEntity="App\Entities\Post"
                            onChange={this.onChangeCategory}
                            message={this.state.errorByFields.category_id}
                            value={parseInt(this.state.formValues.category_id)}
                        />
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
            </div>
        )
    }
}

export default Form
