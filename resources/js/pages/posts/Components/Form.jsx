import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import CategoryField from '../../../containers/category_field'
import AutocompleteField from '../../../containers/autocomplete_field'
import axios from "axios"
import config from "../../../config"

const FORM_FIELD = [
    {slug: 'nha-dat-ban', title: 'Nhà đất bán'},
    {slug: 'nha-dat-cho-thue', title: 'Nhà đất cho thuê'}
]
class Form extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {},
            errorByFields: {},
            priceUnits: []
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

    onChange = (event) => {
        this.setState({ formValues: { ...this.state.formValues, [event.target.name]: event.target.value } })
        if (event.target.name == 'slugParent') {
            this.getPriceUnit(event.target.value)
        }
    }

    async getPriceUnit (slug) {
        const response = await axios.get(`${config.api.baseUrl}/price-unit?slug=${slug}`)
        this.setState({ priceUnits: response.data })
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
                        <select onChange={this.onChange} className="form-control" id="form" name="slugParent">
                            <option value="">-- Hình thức --</option>
                            {
                                FORM_FIELD.map(item => (<option key={item.slug} value={item.slug}>{item.title}</option>))
                            }
                        </select>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <CategoryField
                            label="Loại"
                            isNotFetchCategories={true}
                            destinationEntity="App\Entities\Post"
                            slugParent={this.state.formValues.slugParent}
                            onChange={this.onChange}
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

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Dự án</label>
                        <AutocompleteField
                            endpoint="project/search"
                            onChange={this.onChange}    
                            placeholder="-- Dự án --"
                        />
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Diện tích</label>
                        <div className="w-75 d-flex align-items-center">
                            <input type="number" className="form-control mr-3" name="total_area"/>
                            <span>m2</span>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Giá</label>
                        <input onChange={this.onChange}  type="number" className="form-control mr-3" name="price"/>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Đơn vị</label>
                        <select onChange={this.onChange}  name="price_unit" id="" className="form-control">
                            <option value="">Thỏa thuận</option>
                            {
                                Object.keys(this.state.priceUnits).map((key) => (<option key={key} value={key}>{this.state.priceUnits[key]}</option>))
                            }
                        </select>
                    </div>
                </div>
            </div>
        )
    }
}

export default Form
