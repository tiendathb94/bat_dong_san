import React, { Component } from 'react'
import PropTypes from 'prop-types'

class Line extends Component {
    constructor (props) {
        super(props)

        this.state = {
            value: this.props.value
        }
    }

    static getDerivedStateFromProps (props) {
        return { value: props.value }
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
                    className="form-control"
                />
            </div>
        )
    }
}

Line.propTypes = {
    value: PropTypes.string,
    onChange: PropTypes.func,
}

export default Line
