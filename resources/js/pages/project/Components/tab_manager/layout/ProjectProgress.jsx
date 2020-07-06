import React, { Component } from 'react'
import ImageLibraryUpload from "../../../../../containers/image_ library_upload"

class ProjectProgress extends Component {
    constructor (props) {
        super(props)

        this.state = {
            formValues: {
                date_updload_file: '',
                progressImageFiles: []
            }
        }
        this.imageLibraryUpload = React.createRef()
    }

    componentDidMount() {
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
        })
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
                    <ImageLibraryUpload ref={this.imageLibraryUpload} uploadedImages={
                        this.props.project && this.props.project.progressImages ? this.props.project.progressImages : []
                    }/>
                </div>
            </div>
        )
    }
}

export default ProjectProgress
