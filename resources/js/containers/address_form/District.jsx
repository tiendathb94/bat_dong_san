import React, { Component } from 'react'
import axios from "axios"
import config from "../../config"
import PropTypes from 'prop-types'
import Styles from './address_form.module.scss'
import classnames from 'classnames'

class District extends Component {
    constructor (props) {
        super(props)

        this.state = {
            districts: [],
            loading: false,
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
            this.setState({ districts: [] })
            return
        }

        this.setState({ loading: true })
        const response = await axios.get(`${config.api.baseUrl}/address/districts-by-province?province_id=${this.state.provinceId}`)
        this.setState({ districts: response.data, loading: false })
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
                {
                    this.state.loading && <div className={classnames('spinner-border', Styles.Loading)} role="status">
                        <span className="sr-only">Loading...</span>
                    </div>
                }

                <label>Quận/Huyện</label>
                <select
                    onChange={this.onChange}
                    value={this.state.value}
                    className="form-control"
                    disabled={this.state.districts.length < 1 ? 'disabled' : ''}
                >
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
