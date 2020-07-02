import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { ContentState, EditorState } from 'draft-js'
import htmlToDraft from 'html-to-draftjs'

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
                location: values.location instanceof EditorState ? values.location :
                    EditorState.createWithContent(ContentState.createFromBlockArray(htmlToDraft(values.location || '').contentBlocks)),
                infrastructure: values.infrastructure instanceof EditorState ? values.infrastructure :
                    EditorState.createWithContent(ContentState.createFromBlockArray(htmlToDraft(values.infrastructure || '').contentBlocks)),
            }
        }
    }

    setEditorState (name, editorState) {
        const currentContentState = this.state.formValues[name].getCurrentContent()
        const newContentState = editorState.getCurrentContent()

        if (currentContentState === newContentState) {
            return
        }

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
