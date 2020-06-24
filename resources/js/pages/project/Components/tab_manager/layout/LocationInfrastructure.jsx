import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'


class LocationInfrastructure extends Component {
    render () {
        return (
            <div>
                <div>
                    <div className="form-group">
                        <label>Vị trí</label>
                        <Editor/>
                    </div>

                    <div className="form-group">
                        <label>Hạ tầng</label>
                        <Editor/>
                    </div>
                </div>
            </div>
        )
    }
}

export default LocationInfrastructure
