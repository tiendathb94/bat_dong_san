import React, { Component } from 'react'
import Province from "./Province"
import District from "./District"
import Ward from "./Ward"
import Line from "./Line"
import PropTypes from 'prop-types'
import { isEqual } from 'lodash'

class AddressForm extends Component {
    constructor (props) {
        super(props)

        this.state = {
            provinceId: '',
            districtId: '',
            wardId: '',
            line: '',
            errors: {}
        }
    }

    componentDidUpdate (prevProps, prevState, snapshot) {
        // Sync address value to parent
        if (this.props.onSync && !isEqual(this.state, prevState)) {
            this.props.onSync({
                provinceId: this.state.provinceId,
                districtId: this.state.districtId,
                wardId: this.state.wardId,
                line: this.state.line,
            })
        }
    }

    setFormValue = (fieldName, value) => {
        this.setState({ [fieldName]: value })

        // Reset field
        const fieldDependencies = ['provinceId', 'districtId', 'wardId', 'line']
        const fIndex = fieldDependencies.indexOf(fieldName)
        if (fIndex >= 0) {
            for (let i = fIndex + 1; i < fieldDependencies.length; i++) {
                this.setState({ [fieldDependencies[i]]: '' })
            }
        }
    }

    // Call from parent
    validate () {
        if (this.props.required) {
            const errors = {}
            const fields = ['provinceId', 'districtId', 'wardId', 'line']
            for (let i = 0; i < fields.length; i++) {
                if (!this.state[fields[i]] || this.state[fields[i]].length < 1) {
                    errors[fields[i]] = 'Bạn không được bỏ trống trường này'
                }
            }

            this.setState({ errors })
            return Object.keys(errors).length < 1
        }

        return true
    }

    render () {
        return (
            <div>
                <div className="container">
                    <div className="row">
                        <div className="col col-sm-12 col-md-6">
                            <Province
                                value={this.state.provinceId}
                                onChange={(event) => this.setFormValue('provinceId', event.target.value)}
                                message={this.state.errors['provinceId']}
                            />
                        </div>

                        <div className="col col-sm-12 col-md-6">
                            <District
                                value={this.state.districtId}
                                onChange={(event) => this.setFormValue('districtId', event.target.value)}
                                provinceId={this.state.provinceId}
                                message={this.state.errors['districtId']}
                            />
                        </div>
                    </div>

                    <div className="row">
                        <div className="col col-sm-12 col-md-6">
                            <Ward
                                value={this.state.wardId}
                                onChange={(event) => this.setFormValue('wardId', event.target.value)}
                                districtId={this.state.districtId}
                                message={this.state.errors['wardId']}
                            />
                        </div>

                        <div className="col col-sm-12 col-md-6">
                            <Line
                                value={this.state.line}
                                onChange={(event) => this.setFormValue('line', event.target.value)}
                                message={this.state.errors['line']}
                            />
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

AddressForm.propTypes = {
    onSync: PropTypes.func,
    required: PropTypes.bool
}

export default AddressForm
