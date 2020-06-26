import React, { Component } from 'react'
import axios from "axios"
import config from "../../config"
import PropTypes from 'prop-types'
import classnames from "classnames"
import Styles from "./address_form.module.scss"

class Ward extends Component {
    constructor (props) {
        super(props)

        this.state = {
            wards: [],
            loading: false,
        }
    }

    static getDerivedStateFromProps (props) {
        return { districtId: props.districtId, value: props.value, message: props.message }
    }

    async componentDidUpdate (prevProps, prevState) {
        if (this.state.districtId !== prevState.districtId) {
            await this.fetchWards()
        }
    }

    async fetchWards () {
        if (!this.props.districtId) {
            this.setState({ wards: [] })
            return
        }

        this.setState({ loading: true, wards: [] })
        const response = await axios.get(`${config.api.baseUrl}/address/wards-by-district?district_id=${this.props.districtId}`)
        this.setState({ wards: response.data, loading: false })
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

                <label>Phường/Xã</label>
                <select
                    onChange={this.onChange}
                    value={this.state.value}
                    className={classnames({ 'form-control': true, 'is-invalid': !!this.state.message })}
                    disabled={this.state.wards.length < 1 ? 'disabled' : ''}
                >
                    <option>-- Phường/Xã --</option>
                    {
                        this.state.wards.map((ward) => (
                            <option
                                key={ward.id}
                                value={ward.id}
                            >
                                {ward.name}
                            </option>
                        ))
                    }
                </select>
                {!!this.state.message && <div className="text-danger form-text">{this.state.message}</div>}
            </div>
        )
    }
}

Ward.propTypes = {
    districtId: PropTypes.string,
    value: PropTypes.string,
    onChange: PropTypes.func,
    message: PropTypes.string
}

export default Ward
