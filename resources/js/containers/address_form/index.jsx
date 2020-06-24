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
            line: ''
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

    render () {
        return (
            <div>
                <div className="container">
                    <div className="row">
                        <div className="col">
                            <Province
                                value={this.state.provinceId}
                                onChange={(event) => this.setFormValue('provinceId', event.target.value)}
                            />
                        </div>

                        <div className="col">
                            <District
                                value={this.state.districtId}
                                onChange={(event) => this.setFormValue('districtId', event.target.value)}
                                provinceId={this.state.provinceId}
                            />
                        </div>
                    </div>

                    <div className="row">
                        <div className="col">
                            <Ward
                                value={this.state.wardId}
                                onChange={(event) => this.setFormValue('wardId', event.target.value)}
                                districtId={this.state.districtId}
                            />
                        </div>

                        <div className="col">
                            <Line
                                value={this.state.line}
                                onChange={(event) => this.setFormValue('line', event.target.value)}
                            />
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

AddressForm.propTypes = {
    onSync: PropTypes.func
}

export default AddressForm
