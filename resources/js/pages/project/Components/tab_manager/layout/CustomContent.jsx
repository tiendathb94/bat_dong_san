import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { EditorState, ContentState } from "draft-js"
import htmlToDraft from 'html-to-draftjs'

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
        const values = props.values || {}

        return {
            formValues: {
                ...state.formValues,
                content: values.content instanceof EditorState ? values.content :
                    EditorState.createWithContent(ContentState.createFromBlockArray(htmlToDraft(values.content || '').contentBlocks)),
            }
        }
    }

    onContentChange = (editorState) => {
        const currentContentState = this.state.formValues.content.getCurrentContent()
        const newContentState = editorState.getCurrentContent()

        if (currentContentState !== newContentState) {
            const formValues = { content: editorState }
            this.setState({ formValues })
            this.props.onFormChange(formValues)
        }
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
