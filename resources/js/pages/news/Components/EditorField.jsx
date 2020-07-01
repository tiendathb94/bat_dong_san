import React, { Component } from 'react'
import { Editor } from 'react-draft-wysiwyg'
import { convertToRaw, EditorState } from 'draft-js'
import draftToHtml from "draftjs-to-html"
import { stateFromHTML } from 'draft-js-import-html'

class EditorField extends Component {
    constructor (props) {
        super(props)

        this.state = {
            content: EditorState.createEmpty(),
            ...this.initFormValuesForEditExistRequest(props.request),
            value: ''
        }
    }

    initFormValuesForEditExistRequest (request) {
        if (!request) {
            return {}
        }

        return {
            content: request.content ? EditorState.createWithContent(stateFromHTML(request.content)) : '',
            value: request.content ?? ''
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