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
        var date = today.getDate();
        if(date.toString().length == 1) date = '0' + date;
        var month = today.getMonth() + 1;
        if(month.toString().length == 1) month = '0' + month;
        var year = today.getFullYear();
        return date + '/' + month + '/' + year;
    }

    componentDidMount () {
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            value: this.getDateNow()
        })
    }

    onAddedFiles = (selectedFiles) => {
        const formValues = { ...this.state.formValues, progressImageFiles:  [...this.state.formValues.progressImageFiles, ...Array.from(selectedFiles)] }
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
                    <input className="form-control datepicker" name="date_updload_file" />
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
