import React, { Component } from 'react'
import axios from "axios"
import config from "../../config"
import PropTypes from 'prop-types'

class District extends Component {
    constructor (props) {
        super(props)

        this.state = {
            districts: []
        }
    }

    static getDerivedStateFromProps (props) {
        return { provinceId: props.provinceId, value: props.value }
    }

    async componentDidUpdate (prevProps, prevState) {
        if (this.state.provinceId !== prevState.provinceId) {
            await this.fetchDistricts()
        }
    }

    async fetchDistricts () {
        if (!this.state.provinceId) {
            return
        }

        const response = await axios.get(`${config.api.baseUrl}/address/districts-by-province?province_id=${this.state.provinceId}`)
        this.setState({ districts: response.data })
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
                <label>Quận/Huyện</label>
                <select onChange={this.onChange} value={this.state.value}>
                    <option>-- Quận/Huyện --</option>
                    {
                        this.state.districts && this.state.districts.map((district) => (
                            <option
                                key={district.id}
                                value={district.id}
                            >
                                {district.name}
                            </option>
                        ))
                    }
                </select>
            </div>
        )
    }
}

District.propTypes = {
    provinceId: PropTypes.string,
    value: PropTypes.string,
    onChange: PropTypes.func,
}

export default District
