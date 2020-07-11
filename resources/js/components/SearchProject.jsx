import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { debounce } from 'lodash';
import config from "../config"
import axios from 'axios'

class SearchProject extends Component {
    constructor (props) {
        super(props)

        this.state = {
            isShow: false,
            list: [],
        }
        this.wrapperRef = React.createRef()
        this.inputSearchRef = this.props.inputSearchRef
        this.onKeyUpInputThrottled = debounce(this.onKeyUpInput, 300)
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

    onKeyUpInput = async () => {
        const response = await axios.get(`${config.api.baseUrl}/project/search?keyword=${this.inputSearchRef.current.value}`);
        this.setState({
            list: response.data,
            isShow: true
        })
        this.props.onChange('')
    }

    onChangeItem = (item) => {
        this.inputSearchRef.current.value = item.name
        this.setState({
            list: [],
            isShow: false
        })
        this.props.onChange(item)
    }

    render () {
        return (
            <div className="position-relative search-component" ref={this.wrapperRef}>
                <i className="ti-search"></i>
                <input 
                    ref={this.inputSearchRef}
                    onKeyUp={this.onKeyUpInputThrottled} 
                    type="text" 
                    placeholder={this.props.placeholderInput}
                    className="form-control" />
                {
                    this.state.isShow && (
                        <ul className="border">
                            {
                                this.state.list && this.state.list.map((item) => (<li onClick={() => this.onChangeItem(item)} key={item.value}>{item.name}</li>))
                            }
                        </ul>
                    )
                }
                
            </div>
        )
    }
}

SearchProject.propTypes = {
    onChange: PropTypes.func,
    placeholderInput: PropTypes.string,
}

export default SearchProject