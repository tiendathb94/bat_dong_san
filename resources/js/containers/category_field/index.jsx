import React, { Component } from 'react'
import PropTypes from 'prop-types'
import axios from "axios"
import config from "../../config"
import classnames from "classnames"

class CategoryField extends Component {
    constructor (props) {
        super(props)

        this.state = {
            categories: [],
            value: ''
        }
    }

    static getDerivedStateFromProps (props) {
        return { message: props.message }
    }

    async componentDidMount () {
        await this.fetchCategories()
    }

    async fetchCategories () {
        const response = await axios.get(`${config.api.baseUrl}/category/by-destination-entity?destination_entity=${this.props.destinationEntity}`)
        this.setState({ categories: response.data })
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
                <label>{this.props.label}</label>
                <select
                    onChange={this.onChange}
                    value={this.state.value}
                    className={classnames({ 'form-control': true, 'is-invalid': !!this.state.message })}
                >
                    <option>-- {this.props.label} --</option>
                    {
                        this.state.categories && this.state.categories.map((category) => (
                            <option value={category.id} key={category.id}>{category.name}</option>
                        ))
                    }
                </select>
                {!!this.state.message && <div className="text-danger form-text">{this.state.message}</div>}
            </div>
        )
    }
}

CategoryField.propTypes = {
    label: PropTypes.string,
    onChange: PropTypes.func,
    destinationEntity: PropTypes.string,
    message: PropTypes.string,
}

export default CategoryField
