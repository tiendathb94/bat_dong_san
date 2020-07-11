import React, { Component } from 'react'
import axios from 'axios'
import config from "../../../config"
import Search from "../../../components/Search"
import SearchPrice from "../../../components/SearchPrice"
import SearchProject from "../../../components/SearchProject"

class FormSearch extends Component {
    constructor (props) {
        super(props)

        this.state = {
            isMoreSearch: false,
            keyword: '',
            projectCategories: [],
            categoryId: '',
            provinces: [],
            provinceId: '',
            provinceName: '',
            districts: [],
            districtId: '',
            priceFrom: '',
            priceTo: '',
            project: '',
        }
        this.inputSearchRef = React.createRef()
        this.categoryProjectRef = React.createRef()
        this.inputSearchProvinceRef = React.createRef()
        this.districtRef = React.createRef()
        this.titlePrice = React.createRef()
    }

    openCollapseMoreSearch = () => {
        this.setState({
            isMoreSearch: !this.state.isMoreSearch
        })
    }

    componentDidMount () {
        this.getProjectCategories();
        this.getProvinces();
    }

    getProjectCategories = async () => {
        const response = await axios.get(`${config.api.baseUrl}/category/by-destination-entity?destination_entity=App\\Entities\\Project`);
        this.setState({
            projectCategories: response.data
        })
    }

    getProvinces = async () => {
        const response = await axios.get(`${config.api.baseUrl}/address/provinces`);
        this.setState({
            provinces: response.data
        })
    }

    getDistricts = async (provinceId, districtId) => {
        const response = await axios.get(`${config.api.baseUrl}/address/districts-by-province?province_id=${provinceId}`);
        this.setState({
            districts: response.data
        })
        if (districtId) {
            this.districtRef.current.value = districtId
        }
    }

    setPrice = (from, to) => {
        this.setState({
            priceFrom: from,
            priceTo: to
        })
    }

    onChangeProvince = (value, id) => {
        this.setState({
            provinceName: value,
            provinceId: id
        })
        this.inputSearchRef.current.value = ''
        if (id) {
            this.getDistricts(id)
        } else {
            this.setState({
                districts: [],
                districtName: '',
                districtId: '',
                provinceId: '',
                priceFrom: '',
                priceTo: '',
            })
        }
    }

    onChangeSelect = (e) => {
        this.inputSearchRef.current.value = ''
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    onChangeProject = (project) => {
        if (project && project.id) {
            this.getDistricts(project.address.province_id, project.address.district_id)
            this.categoryProjectRef.current.value = project.category_id
            this.setState({
                project: project,
                provinceId: project.address.province_id,
                provinceName: project.address.province.name,
                districtId: project.address.district_id
            })
            this.inputSearchProvinceRef.current.value = project.address.province.name
        } else {
            this.setState({
                project: {},
                provinceId: '',
                provinceName: '',
                districtId: '',
                districts: []
            })
            this.inputSearchProvinceRef.current.value = ''
            this.categoryProjectRef.current.value = ''
            this.titlePrice.current.textContent = 'Mức giá'
        }
    }

    searchProject = () => {
        const { project, provinceId, districtId, projectCategories, categoryId, priceFrom, priceTo } = this.state
        const keyword = this.inputSearchRef.current.value
        if(project && project.slug) {
            window.location = `/du-an/${project.category.slug}/${project.slug}`
        } else if (categoryId) {
            const category = projectCategories.filter(category => category.id == categoryId)[0]
            window.location = `/du-an/${category.slug}?province_id=${provinceId}&district_id=${districtId}&priceFrom=${priceFrom}&priceTo=${priceTo}`
        } else if (keyword) {
            window.location = `/tim-kiem-du-an?keyword=${keyword}`
        }
    }

    render () {
        return (
            <div className="row border mx-0 mb-3 py-3 form-search">
                <div className="col-12 col-lg-2">
                    <h5 className="text-primary font-weight-bold mt-2">TÌM KIẾM DỰ ÁN</h5>
                </div>
                <div className="col-12 col-lg-8">
                    <div className="row">
                        <div className="col-12">
                            <SearchProject 
                                onChange={this.onChangeProject}
                                inputSearchRef={this.inputSearchRef}
                                placeholderInput="Nhập từ khóa tìm kiếm theo tên dự án"
                                />
                        </div>
                    </div>
                    {
                        this.state.isMoreSearch && (
                            <div className="row">
                                <div className="col-12 col-md-6 col-lg-3 mt-3">
                                    <select ref={this.categoryProjectRef} onChange={this.onChangeSelect} name="categoryId" id="" className="form-control">
                                        <option value="">Loại dự án</option>
                                        {
                                            this.state.projectCategories.map((category) => (<option key={category.id} value={category.id}>{category.name}</option>))
                                        }
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-3 mt-3">
                                    <Search onChange={this.onChangeProvince}
                                        inputSearchProvinceRef={this.inputSearchProvinceRef}
                                        defaultValue={this.state.provinceName} 
                                        placeholderInput="Tỉnh thành"
                                        list={this.state.provinces} />
                                </div>
                                <div className="col-12 col-md-6 col-lg-3 mt-3">
                                    <select ref={this.districtRef} onChange={this.onChangeSelect} name="districtId" id="" className="form-control">
                                        <option value="">Quận huyện</option>
                                        {
                                            this.state.districts.map((district) => (<option key={district.id} value={district.id}>{district.name}</option>))
                                        }
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-3 mt-3">
                                    <SearchPrice titlePrice={this.titlePrice} setPrice={this.setPrice} />
                                </div>
                            </div>
                        )
                    }
                    
                    <div className="row mt-3">
                        <div className="col font-italic">
                            {
                                this.state.isMoreSearch ? (
                                <div className="d-flex justify-content-center align-items-center"><span className="cursor-pointer" onClick={this.openCollapseMoreSearch}>Thu gọn chỉ tiêu tìm kiếm <i className="ti-angle-up ml-2"></i></span></div>
                                ) : (
                                    <div className="d-flex justify-content-center align-items-center"><span className="cursor-pointer" onClick={this.openCollapseMoreSearch}>Mở rộng chỉ tiêu tìm kiếm <i className="ti-angle-down ml-2"></i></span></div>
                                )
                            }
                            
                        </div>
                    </div>
                </div>
                <div className="col-12 col-lg-2 text-center">
                    <button onClick={this.searchProject} className="btn btn-primary" type="button">
                        <i className="ti-search"></i> Tìm kiếm
                    </button>
                </div>
            </div>
        )
    }
}

export default FormSearch