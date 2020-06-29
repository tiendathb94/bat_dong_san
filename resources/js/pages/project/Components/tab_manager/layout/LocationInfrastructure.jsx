import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { EditorState } from 'draft-js'
import { stateFromHTML } from "draft-js-import-html"

class LocationInfrastructure extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                location: EditorState.createEmpty(),
                infrastructure: EditorState.createEmpty(),
            }
        }
    }

    static getDerivedStateFromProps (props, state) {
        const values = props.values || {}

        return {
            formValues: {
                ...state.formValues,
                location: EditorState.createWithContent(stateFromHTML(values.location || '')),
                infrastructure: EditorState.createWithContent(stateFromHTML(values.infrastructure || '')),
            }
        }
    }

    setEditorState (name, editorState) {
        const formValues = { ...this.state.formValues, [name]: editorState }
        this.setState({ formValues })

        if (this.props.onFormChange) {
            this.props.onFormChange(formValues)
        }
    }

    render () {
        return (
            <div>
                <div>
                    <div className="form-group">
                        <label>Vị trí</label>
                        <Editor
                            editorState={this.state.formValues.location}
                            onEditorStateChange={(editorState) => this.setEditorState('location', editorState)}
                        />
                    </div>

                    <div className="form-group">
                        <label>Hạ tầng</label>
                        <Editor
                            editorState={this.state.formValues.infrastructure}
                            onEditorStateChange={(editorState) => this.setEditorState('infrastructure', editorState)}
                        />
                    </div>
                </div>
            </div>
        )
    }
}

export default LocationInfrastructure
