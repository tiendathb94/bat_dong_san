import React, { Component } from 'react'
import PropTypes from 'prop-types'

class Search extends Component {
    constructor (props) {
        super(props)

        this.state = {
            isShow: false,
            list: [],
            listFilter: [],
            defaultValue: ''
        }
        this.wrapperRef = React.createRef()
        this.inputSearch = this.props.inputSearchProvinceRef
    }

    static getDerivedStateFromProps (props, prevState) {
        return { list: props.list, defaultValue: props.defaultValue }
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
        this.inputSearch.current.value = item.name
        this.setState({
            isShow: false
        })
        this.props.onChange(item.name, item.id)
    }

    onFocusInput = () => {
        this.setState({defaultValue: ''})
        this.inputSearch.current.value = ''
        this.setState({
            listFilter: this.state.list,
            isShow: true,
        })
        this.props.onChange()
    }

    filterValue = (e) => {
        var textSearch = '';
        if (e) {
            textSearch = e.target.value
        } else {
            textSearch = this.state.defaultValue
        }
        const newList = this.state.list.filter((item) => {
            if (item.name.toLowerCase().indexOf(textSearch) > -1) return item
        })
        this.setState({
            listFilter: newList,
            isShow: true,
        })
        this.props.onChange(textSearch)
    }

    render () {
        return (
            <div className="position-relative search-component" ref={this.wrapperRef}>
                <i className="ti-search"></i>
                <input 
                    onFocus={this.onFocusInput} 
                    ref={this.inputSearch} 
                    onKeyUp={this.filterValue} 
                    type="text" 
                    defaultValue={this.state.defaultValue}
                    placeholder={this.props.placeholderInput}
                    className="form-control" />
                {
                    this.state.isShow && (
                        <ul className="border">
                            {
                                this.state.listFilter && this.state.listFilter.map((item) => (<li onClick={() => this.onChange(item)} key={item.id}>{item.name}</li>))
                            }
                        </ul>
                    )
                }
                
            </div>
        )
    }
}

Search.propTypes = {
    list: PropTypes.array,
    onChange: PropTypes.func,
    defaultValue: PropTypes.string,
    placeholderInput: PropTypes.string,
}

export default Search