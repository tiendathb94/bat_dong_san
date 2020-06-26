import React, { Component } from 'react'
import PropTypes from 'prop-types'
import classnames from "classnames"

class Line extends Component {
    constructor (props) {
        super(props)

        this.state = {
            value: this.props.value
        }
    }

    static getDerivedStateFromProps (props) {
        return { value: props.value, message: props.message }
    }

    onChange = (event) => {
        if (this.props.onChange) {
            this.props.onChange(event)
        }

        this.setState({ value: event.target.value })
    }


    render () {
        return (
            <div className="form-group">
                <label>Đường/Phố</label>
                <input
                    value={this.state.value}
                    onChange={this.onChange}
                    placeholder="Nhập đường phố"
                    className={classnames({ 'form-control': true, 'is-invalid': !!this.state.message })}
                />
                {!!this.state.message && <div className="text-danger form-text">{this.state.message}</div>}
            </div>
        )
    }
}

Line.propTypes = {
    value: PropTypes.string,
    onChange: PropTypes.func,
    message: PropTypes.string,
}

export default Line
