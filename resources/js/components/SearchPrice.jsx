import React, { Component } from 'react'
import PropTypes from 'prop-types'

const LIST_VALUE = [
    { from: 0, to: 0, title: 'Mức giá' },
    { from: 0, to: 0, title: 'Thỏa thuận' },
    { from: 0, to: 500, title: '< 500 triệu' },
    { from: 500, to: 800, title: '500 - 800 triệu' },
    { from: 800, to: 1000, title: '800 triệu - 1 tỷ' },
    { from: 1000, to: 2000, title: '1 - 2 tỷ' },
    { from: 2000, to: 3000, title: '2 - 3 tỷ' },
    { from: 3000, to: 5000, title: '3 - 5 tỷ' },
    { from: 5000, to: 7000, title: '5 - 7 tỷ' },
    { from: 7000, to: 10000, title: '7 - 10 tỷ' },
    { from: 10000, to: 20000, title: '10 - 20 tỷ' },
    { from: 20000, to: 30000, title: '20 - 30 tỷ' },
    { from: 30000, to: 0, title: '> 30 tỷ' },
]

class SearchPrice extends Component {
    constructor (props) {
        super(props)

        this.state = {
            isShow: false,
            fromPrice: '',
            toPrice: '',
        }
        this.wrapperRef = React.createRef()
        this.titleRef = this.props.titlePrice
        this.fromPriceRef = React.createRef()
        this.toPriceRef = React.createRef()
        this.listPrice = LIST_VALUE;
    }

    componentDidMount() {
        document.addEventListener('click', this.handleClick)
    }
      
    componentWillUnmount() {
        document.removeEventListener('click', this.handleClick)
    }

    handleClick = (event) => {
        const { target } = event
        if (!this.wrapperRef.current.contains(target)) {
            this.setState({
                isShow: false
            })
        }
    }

    onChange = (item) => {
        this.titleRef.current.textContent = item.title
        this.setState({
            isShow: false
        })
        this.props.setPrice(item.from, item.to)
    }

    openDropdownBoxPrice = () => {
        this.setState({
            isShow: true
        })
    }

    changePrice = async (e) => {
        await this.setState({
            [e.target.name]: e.target.value
        })
        await this.getTitleByPrice()
    }

    getTitleByPrice = () => {
        var { fromPrice, toPrice } = this.state
        if (fromPrice !== '' && toPrice !== '') {
            this.titleRef.current.textContent = this.getUnitPrice(fromPrice) + ' - ' + this.getUnitPrice(toPrice)
        } else if (fromPrice !== '') {
            this.titleRef.current.textContent = '>= ' + this.getUnitPrice(fromPrice)
        } else if (toPrice !== '') {
            this.titleRef.current.textContent = '<= ' + this.getUnitPrice(toPrice)
        } else {
            this.titleRef.current.textContent = 'Mức giá'
        }
        this.props.setPrice(fromPrice, toPrice)
    }

    getUnitPrice = (price) => {
        if (price >= 1000) {
            return price/1000 + ' tỷ'
        }
        return price + ' triệu'
    }

    render () {
        return (
            <div className="position-relative search-component" ref={this.wrapperRef}>
                <div className="position-relative search-price-component" onClick={this.openDropdownBoxPrice}>
                    <i className="ti-search"></i>
                    <span ref={this.titleRef}>Mức giá</span>
                </div>
                {
                    this.state.isShow && (
                        <div className="bg-white">
                            <div className="d-flex justify-content-center p-2 border">
                                <input type="number" onKeyUp={this.changePrice} className="text-center" name="fromPrice"/>
                                <span className="mx-2"> - </span>
                                <input type="number" onKeyUp={this.changePrice} className="text-center" name="toPrice"/>
                            </div>
                            <ul className="border">
                                {
                                    this.listPrice.map((item) => (<li onClick={() => this.onChange(item)} key={item.title}>{item.title}</li>))
                                }
                            </ul>
                        </div>
                    )
                }
            </div>
        )
    }
}

SearchPrice.propTypes = {
    setPrice: PropTypes.func
}

export default SearchPrice