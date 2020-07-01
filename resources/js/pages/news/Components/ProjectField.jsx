import React, { Component } from 'react'
import AutocompleteField from "../../../containers/autocomplete_field"
import { convertToRaw, EditorState } from 'draft-js'
import draftToHtml from "draftjs-to-html"
import { stateFromHTML } from 'draft-js-import-html'

class ProjectField extends Component {
    constructor (props) {
        super(props)

        this.state = {
            project_id: '',
            project_name: '',
            ...this.initFormValuesForEditExistRequest(props.request)
        }
    }

    initFormValuesForEditExistRequest (request) {
        if (!request) {
            return {}
        }
        return {
            project_id: request.project_id ?? '',
            project_name: request.project_name ?? ''
        }
    }

    onChangeProjectId = (projectId, projectName) => {
        this.setState({ project_id: projectId, project_name: projectName })
    }

    render () {
        return (
        <div>
            <AutocompleteField
                endpoint="project/search"
                onChange={this.onChangeProjectId}
                placeholder="Nhập tên dự án để tìm kiếm"
                name={this.state.project_name}
                emptyValue={true}
                selectedItem={
                    this.props.request && this.props.request.project_id ? {
                        value: this.props.request.project_id,
                        name: this.props.request.project_name
                    } : {}
                }
            />
            <input type="hidden" name="project_id" id="project_id" value={this.state.project_id} />
            <input type="hidden" name="project_name" value={this.state.project_name} />
        </div>
        )
    }
}

export default ProjectField