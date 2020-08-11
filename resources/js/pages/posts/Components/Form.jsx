import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import CategoryField from '../../../containers/category_field'
import AutocompleteField from '../../../containers/autocomplete_field'
import axios from "axios"
import config from "../../../config"
import { Editor } from 'react-draft-wysiwyg'
import ImageLibraryUpload from "../../../containers/image_ library_upload"
import draftToHtml from "draftjs-to-html"
import { convertToRaw, EditorState } from "draft-js"

const FORM_FIELD = [
    {slug: 'nha-dat-ban', title: 'Nhà đất bán'},
    {slug: 'nha-dat-cho-thue', title: 'Nhà đất cho thuê'}
]
class Form extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
            },
            errorByFields: {},
            priceUnits: [],
            totalPrice: '',
            direction: [],
            errors: [],
            editorState: EditorState.createEmpty()
        }

        this.addressField = React.createRef()
        this.imageLibraryUpload = React.createRef()
        this.totalAreaField = React.createRef()
        this.priceField = React.createRef()
        this.priceUnitField = React.createRef()
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

    renderFieldError (fieldName) {
        if (!this.state.errorByFields[fieldName]) {
            return ''
        }

        return <div className="text-danger form-text">{this.state.errorByFields[fieldName]}</div>
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
        if (event.target.name == 'price' || event.target.name == 'price_unit' || event.target.name == 'total_area') {
            this.setTotalPrice()
        }
    }

    componentDidMount = () => {
        this.getDirection();
    }

    async getPriceUnit (slug) {
        const response = await axios.get(`${config.api.baseUrl}/posts/price-unit?slug=${slug}`)
        this.setState({ priceUnits: response.data })
    }

    async getDirection () {
        const response = await axios.get(`${config.api.baseUrl}/posts/direction`)
        this.setState({ direction: response.data })
    }

    onContentChange = (editorState) => {
        this.setState({ editorState })
    }

    onChangeProject = (value, name) => {
        this.setState({ formValues: { ...this.state.formValues, [name]: value } })
    }

    setTotalPrice = () => {
        var total_area = this.totalAreaField.current.value
        var price = this.priceField.current.value
        var price_unit = this.priceUnitField.current.value
        var textTotalPrice = '';
        var totalPrice = 0;
        if (price && price_unit) {
            if (total_area) {
                switch(price_unit) {
                    case '3':
                        totalPrice = price * 100000 * total_area;
                        textTotalPrice = this.convertTitlePrice(totalPrice)
                        break
                    case '4':
                        totalPrice = price * 1000000 * total_area
                        textTotalPrice = this.convertTitlePrice(totalPrice)
                        break
                    case '7':
                        totalPrice = price * 100000 * total_area
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    case '8':
                        totalPrice = price * 1000000 * total_area
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    case '9':
                        totalPrice = price * 1000 * total_area
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    case '1':
                        totalPrice = price * 1000000;
                        textTotalPrice = this.convertTitlePrice(totalPrice)
                        break
                    case '2':
                        totalPrice = price * 1000000000
                        textTotalPrice = this.convertTitlePrice(totalPrice)
                        break
                    case '5':
                        totalPrice = price * 100000
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    case '6':
                        totalPrice = price * 1000000
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    default:
                        totalPrice = 0
                        textTotalPrice = 'thỏa thuận'
                }
            } else {
                switch(price_unit) {
                    case '1':
                        totalPrice = price * 1000000;
                        textTotalPrice = this.convertTitlePrice(totalPrice)
                        break
                    case '2':
                        totalPrice = price * 1000000000
                        textTotalPrice = this.convertTitlePrice(totalPrice)
                        break
                    case '5':
                        totalPrice = price * 100000
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    case '6':
                        totalPrice = price * 1000000
                        textTotalPrice = this.convertTitlePrice(totalPrice) + '/tháng'
                        break
                    default:
                        totalPrice = 0
                        textTotalPrice = 'thỏa thuận'
                }
            }
        } else {
            totalPrice = 0
            textTotalPrice = 'Thỏa thuận'
        }
        this.setState({
            totalPrice: textTotalPrice,
            formValues: {
                ...this.state.formValues,
                total_price: totalPrice
            }
        })
    }

    convertTitlePrice = (price) => {
        if (price >= 1000000000) return price/1000000000 + ' tỷ'
        if (price >= 1000000) return price/1000000 + ' triệu'
        if (price >= 100000) return price/100000 + ' trăm nghìn'
        if (price >= 1000) return price/1000 + ' nghìn'
        return price
    }

    validate () {
        const errorByFields = {}

        // Validate required fields
        const requiredFields = ['title', 'slugParent']
        for (let i = 0; i < requiredFields.length; i++) {
            const fieldName = requiredFields[i]
            if (!this.state.formValues[fieldName]) {
                errorByFields[fieldName] = 'Bạn không được bỏ trống trường này'
            }
        }
        this.setState({ errorByFields })
        const addressValid = this.addressField.current.validate()

        return Object.keys(errorByFields).length < 1 && addressValid
    }

    onSubmitData = async () => {
        if (!this.validate()) {
            window.scrollTo(0, 0)
            return
        }
        const { formValues} = this.state;
        formValues['total_area'] = this.totalAreaField.current.value
        formValues['price_unit'] = this.priceUnitField.current.value
        formValues['price'] = this.priceField.current.value
        formValues['content'] = draftToHtml(convertToRaw(this.state.editorState.getCurrentContent()))
        try {
            this.setState({ loading: true })

            // Create project
            const response = await axios.post(`${config.api.baseUrl}/posts`, formValues);
            const data = response.data
            await this.imageLibraryUpload.current.doUpload(
                'App\\Entities\\Post',
                data.data.post.id,
                'post',
            )
            this.setState({
                loading: false,
                message: 'Thêm thành công'
            })
            window.location.href = '/quan-ly-tin-rao-vat-ban-nha-dat';
        } catch (e) {
            if (e.response && e.response.data) {
                window.scrollTo(0, 0)
                if (e.response.data.errors) {
                    const stateErrors = []
                    const errors = Object.values(e.response.data.errors)
                    for (let i = 0; i < errors.length; i++) {
                        stateErrors.push(errors[i].join(' '))
                    }
                    this.setState({ errors: stateErrors, loading: false, })
                } else {
                    this.setState({ errors: e.response.data.message || 'Đã có lỗi sảy ra vui lòng thử lại', loading: false, })
                }
                setTimeout(() => {
                    this.setState({
                        errors: {}
                    })
                }, 5000)
            }
        }
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
                        <h4>Thông tin cơ bản</h4>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12">
                        <label htmlFor="title">Tiêu đề <span className="text-danger">(*)</span></label>
                        <input onChange={this.onChange} type="text" className="form-control" id="title" name="title"/>
                        {this.renderFieldError('title')}
                    </div>
                </div>
                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="form">Hình thức <span className="text-danger">(*)</span></label>
                        <select onChange={this.onChange} className="form-control" id="form" name="slugParent">
                            <option value="">-- Hình thức --</option>
                            {
                                FORM_FIELD.map(item => (<option key={item.slug} value={item.slug}>{item.title}</option>))
                            }
                        </select>
                        {this.renderFieldError('slugParent')}
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
                            onChange={this.onChangeProject}    
                            placeholder="-- Dự án --"
                        />
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Diện tích</label>
                        <div className="w-75 d-flex align-items-center">
                            <input type="number" ref={this.totalAreaField} onChange={this.onChange} className="form-control mr-3" name="total_area"/>
                            <span>m2</span>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Giá</label>
                        <input onChange={this.onChange} ref={this.priceField}  type="number" className="form-control mr-3" name="price"/>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Đơn vị</label>
                        <select onChange={this.onChange} ref={this.priceUnitField} name="price_unit" id="" className="form-control">
                            <option value="">Thỏa thuận</option>
                            {
                                Object.keys(this.state.priceUnits).map((key) => (<option key={key} value={key}>{this.state.priceUnits[key]}</option>))
                            }
                        </select>
                    </div>
                </div>
                
                <div className="row mt-3">
                    <div className="col">
                        <p>Tổng giá tiền <span className="text-danger">{this.state.totalPrice}</span></p>
                    </div>
                </div>

                <div className="row">
                    <div className="col">
                        <label htmlFor="">Mô tả <span className="text-danger">(*)</span></label>
                        <Editor
                            editorState={this.state.editorState}
                            onEditorStateChange={this.onContentChange}
                        />
                        {this.renderFieldError('content')}
                    </div>
                </div>
                
                <div className="row mt-3">
                    <div className="col">
                        <label htmlFor="">Tải lên hình ảnh</label>
                        <ImageLibraryUpload ref={this.imageLibraryUpload} uploadedImages={
                            this.props.post && this.props.post.imageLibraries ? this.props.post.imageLibraries : []
                        }/>
                    </div>
                </div>

                <div className="row mt-3">
                    <div className="col">
                        <h4>Thông tin khác</h4>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Mặt tiền (m)</label>
                        <input onChange={this.onChange} type="text" className="form-control" id="" name="facade"/>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Đường vào (m)</label>
                        <input onChange={this.onChange} type="text" className="form-control" id="" name="way_in"/>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Hướng nhà</label>
                        <select onChange={this.onChange} className="form-control" id="" name="direction_house">
                            {
                                this.state.direction.map((value, key) => (<option key={key} value={key}>{value}</option>))
                            }
                        </select>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Hướng ban công</label>
                        <select onChange={this.onChange} className="form-control" id="" name="direction_balcony">
                            {
                                this.state.direction.map((value, key) => (<option key={key} value={key}>{value}</option>))
                            }
                        </select>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Số tầng</label>
                        <input type="number" onChange={this.onChange} className="form-control" id="" name="number_of_floors"/>
                    </div>
                </div>

                <div className="row">
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Số phòng ngủ</label>
                        <input type="number" onChange={this.onChange} className="form-control" id="" name="number_of_bedroom"/>
                    </div>
                    <div className="col col-sm-12 col-md-6">
                        <label htmlFor="">Số toilet</label>
                        <input type="number" onChange={this.onChange} className="form-control" id="" name="number_of_toilet"/>
                    </div>
                </div>

                <div className="row">
                    <div className="col">
                        <label htmlFor="">Nội thất</label>
                        <textarea onChange={this.onChange} name="furniture" className="form-control" id="" rows="3"></textarea>
                    </div>
                </div>

                <div className="row">
                    <div className="col">
                        <label htmlFor="">Thông tin pháp lý</label>
                        <textarea onChange={this.onChange} className="form-control" placeholder="Ví dụ: đã có sổ đỏ, sổ hồng,..." name="legal_information" id="" rows="3"></textarea>
                    </div>
                </div>

                <div className="row mt-3">
                    <div className="col d-flex justify-content-center">
                        <button type="button" onClick={this.onSubmitData} className="btn btn-success mr-3">Đăng tin</button>
                    </div>
                </div>
            </div>
        )
    }
}

export default Form
