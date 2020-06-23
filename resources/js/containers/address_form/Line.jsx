import React, { Component } from 'react'
import PropTypes from 'prop-types'

class Line extends Component {
    constructor (props) {
        super(props)

        this.state = {
            value: this.props.value
        }
    }

    onChange = (event) => {
        if (this.props.onChange) {
            this.props.onChange(event)
        }

        this.setState({ value: event.target.value })
    }


    render () {
        return (
            <div>
                <label>Đường/Phố</label>
                <input value={this.state.value} onChange={this.onChange} placeholder="Nhập đường phố"/>
            </div>
        )
    }
}

Line.propTypes = {
    value: PropTypes.string,
    onChange: PropTypes.func,
}

export default Line
