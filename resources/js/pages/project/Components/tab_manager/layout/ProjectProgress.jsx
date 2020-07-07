import React, { Component } from 'react'
import ImageLibraryUpload from "../../../../../containers/image_ library_upload"

class ProjectProgress extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                date_updload_file: this.getDateNow(),
                progressImageFiles: [],
                removeFileIds: []
            }
        }
        this.imageLibraryUpload = React.createRef()
    }

    getDateNow = () => {
        var today = new Date();
        var date =  today.toISOString().substr(0, 10);
        return date;
    }

    onAddedFiles = (selectedFiles) => {
        const formValues = { ...this.state.formValues, progressImageFiles:  Array.from(selectedFiles) }
        this.setState({ formValues })

        if (this.props.onFormChange) {
            this.props.onFormChange(formValues)
        }
    }

    onRemoveFile = (fileId, isUploaded = false) => {
        const formValues = this.state.formValues
        if (isUploaded) {
            formValues.removeFileIds.push(fileId)
        } else {
            formValues.progressImageFiles.splice(fileId, 1)
        }
        this.setState({ formValues })
        if (this.props.onFormChange) {
            this.props.onFormChange(formValues)
        }
    }

    onChangeInput = (event) => {
        const formValues = { ...this.state.formValues, [event.target.name]:  event.target.value }
        this.setState({ formValues })

        if (this.props.onFormChange) {
            this.props.onFormChange(formValues)
        }
    }

    render () {
        return (
            <div className="row mt-2">
                <div className="col-12">
                    <label>Ngày cập nhật tiến độ</label>
                    <input onChange={this.onChangeInput} defaultValue={this.getDateNow()} type="date" className="form-control" name="date_updload_file" />
                </div>
                <div className="col-12">
                    <label>Tải lên hình ảnh của dự án</label>
                    <ImageLibraryUpload 
                        ref={this.imageLibraryUpload}
                        projectProgressTitleDate='Ngày cập nhật tiến độ'
                        onAddedFiles={this.onAddedFiles}
                        onRemoveFile={this.onRemoveFile}
                        uploadedImages={
                            this.props.project && this.props.project.progressImages ? this.props.project.progressImages : []
                    }/>
                </div>
            </div>
        )
    }
}

export default ProjectProgress
