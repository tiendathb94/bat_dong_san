import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { EditorState } from "draft-js"

class CustomContent extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                content: EditorState.createEmpty(),
            }
        }
    }

    static getDerivedStateFromProps (props, state) {
        return { formValues: { ...state.formValues, ...props.values } }
    }

    onContentChange = (editorState) => {
        const formValues = { content: editorState }
        this.setState({ formValues })
        this.props.onFormChange(formValues)
    }

    render () {
        return (
            <div className="form-group">
                <label>Nội dung</label>
                <Editor
                    editorState={this.state.formValues.content}
                    onEditorStateChange={this.onContentChange}
                />
            </div>
        )
    }
}

export default CustomContent
