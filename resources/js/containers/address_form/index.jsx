import React, { Component } from 'react'
import Province from "./Province"
import District from "./District"
import Ward from "./Ward"
import Line from "./Line"

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

    setFormValue = (fieldName, value) => {
        this.setState({ [fieldName]: value })
    }

    render () {
        return (
            <div>
                <Province
                    value={this.state.provinceId}
                    onChange={(event) => this.setFormValue('provinceId', event.target.value)}
                />
                <District
                    value={this.state.districtId}
                    onChange={(event) => this.setFormValue('districtId', event.target.value)}
                    provinceId={this.state.provinceId}
                />
                <Ward
                    value={this.state.wardId}
                    onChange={(event) => this.setFormValue('wardId', event.target.value)}
                    districtId={this.state.districtId}
                />
                <Line
                    value={this.state.line}
                    onChange={(event) => this.setFormValue('line', event.target.value)}
                />
            </div>
        )
    }
}

export default AddressForm
