import React, { Component } from 'react'
import PropTypes from 'prop-types'
import axios from "axios"
import config from "../../config"
import classnames from "classnames"

class CategoryField extends Component {
    constructor (props) {
        super(props)

        this.state = {
            categories: []
        }
    }

    static getDerivedStateFromProps (props) {
        return { message: props.message, value: props.value, slugParent: props.slugParent || '' }
    }

    async componentDidMount () {
        if (!this.props.isNotFetchCategories) {
            await this.fetchCategories()
        }
    }

    async componentDidUpdate (prevProps) {
        if(this.state.slugParent && prevProps.slugParent !== this.state.slugParent) {
            await this.fetchCategories()
        }
    }

    async fetchCategories () {
        const response = await axios.get(`${config.api.baseUrl}/category/by-destination-entity?destination_entity=${this.props.destinationEntity}&slug_parent=${this.state.slugParent}`)
        console.log(`${config.api.baseUrl}/category/by-destination-entity?destination_entity=${this.props.destinationEntity}&slug_parent=${this.state.slugParent}`)
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
                    name="category_id"
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
    value: PropTypes.number,
    onChange: PropTypes.func,
    destinationEntity: PropTypes.string,
    message: PropTypes.string,
    slugParent: PropTypes.string,
    isNotFetchCategories: PropTypes.bool
}

export default CategoryField
