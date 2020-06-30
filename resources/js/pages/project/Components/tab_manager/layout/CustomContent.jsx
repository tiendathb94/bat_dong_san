import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { EditorState } from "draft-js"
import { stateFromHTML } from "draft-js-import-html"

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
                    EditorState.createWithContent(stateFromHTML(values.content || '')),
            }
        }
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
