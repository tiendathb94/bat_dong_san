import React, { Component } from 'react'
import PropTypes from 'prop-types'
import classnames from 'classnames'
import Style from './autocomplete_field.module.scss'

class Input extends Component {
    constructor (props) {
        super(props)

        this.state = {
            keyword: '',
            showKeyword: false
        }
    }

    static getDerivedStateFromProps (props) {
        return { selectedItemName: props.selectedItemName }
    }

    onChange = (event) => {
        this.setState({ keyword: event.target.value })
        if (this.props.onInputComplete) {
            this.props.onInputComplete(event.target.value)
        }
    }

    onFocus = () => {
        this.setState({ showKeyword: true })
    }

    onBlur = () => {
        this.setState({ showKeyword: false })
    }

    render () {
        return (
            <div className={Style.autocompleteFieldInputWrapper}>
                <div className={classnames('form-group', 'mb-0')}>
                    <span className="ti-search"></span>
                    <input
                        className="form-control"
                        placeholder={this.props.placeholder || 'Nhập từ khóa'}
                        onChange={this.onChange}
                        onFocus={this.onFocus}
                        onBlur={this.onBlur}
                        value={this.state.showKeyword ? this.state.keyword : this.state.selectedItemName}
                    />
                    <p className="text-muted small">
                        Nhập từ khóa để tìm kiếm, ngay sau khi nhập từ khóa hệ thống sẽ hiển
                        thị ra những mục phù hợp để lựa chọn
                    </p>
                </div>
            </div>
        )
    }
}

Input.propTypes = {
    onInputComplete: PropTypes.func,
    selectedItemName: PropTypes.string,
    placeholder: PropTypes.string,
}

export default Input
