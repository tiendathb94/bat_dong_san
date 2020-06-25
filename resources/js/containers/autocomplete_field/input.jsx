import React, { Component } from 'react'
import PropTypes from 'prop-types'
import classnames from 'classnames'
import Style from './autocomplete_field.module.scss'

class Input extends Component {
    onChange = (event) => {
        if (this.props.onInputComplete) {
            this.props.onInputComplete(event.target.value)
        }
    }

    render () {
        return (
            <div className={Style.autocompleteFieldInputWrapper}>
                <div className={classnames('form-group', 'mb-0')}>
                    <span className="ti-search"></span>
                    <input className="form-control" placeholder="Nhập từ khóa" onChange={this.onChange}/>
                    <p className="text-muted small">Nhập từ khóa để tìm kiếm, ngay sau khi nhập từ khóa hệ thống sẽ hiển thị ra những mục phù hợp để lựa chọn</p>
                </div>
            </div>
        )
    }
}

Input.propTypes = {
    onInputComplete: PropTypes.func
}

export default Input
