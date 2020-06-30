import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { convertToRaw, EditorState } from 'draft-js'
import draftToHtml from "draftjs-to-html"

class EditorField extends Component {
    constructor (props) {
        super(props)

        this.state = {
            content: EditorState.createEmpty(),
            value: ''
        }
    }

    onContentChange = (editorState) => {
        this.setState({  
            content: editorState,
            value: draftToHtml(convertToRaw(editorState.getCurrentContent()))
        })
    }

    render () {
        return (
        <div>
            <Editor
                    editorState={this.state.content}
                    onEditorStateChange={this.onContentChange}
                />
            <input type="hidden" name="content" value={this.state.value} />
        </div>
        )
    }
}

export default EditorField