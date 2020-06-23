import React, { Component } from 'react'
import axios from "axios"
import config from "../../config"
import PropTypes from 'prop-types'

class Ward extends Component {
    constructor (props) {
        super(props)

        this.state = {
            wards: []
        }
    }

    static getDerivedStateFromProps (props) {
        return { districtId: props.districtId, value: props.value }
    }

    async componentDidUpdate (prevProps, prevState) {
        if (this.state.districtId !== prevState.districtId) {
            await this.fetchWards()
        }
    }

    async fetchWards () {
        if (!this.props.districtId) {
            return
        }

        const response = await axios.get(`${config.api.baseUrl}/address/wards-by-district?district_id=${this.props.districtId}`)
        this.setState({ wards: response.data })
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
                <label>Phường/Xã</label>
                <select onChange={this.onChange} value={this.state.value}>
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
            </div>
        )
    }
}

Ward.propTypes = {
    districtId: PropTypes.string,
    value: PropTypes.string,
    onChange: PropTypes.func,
}

export default Ward
