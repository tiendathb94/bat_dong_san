import React, { Component } from 'react'
import UploadBox from "./UploadBox"
import PreviewItem from "./PreviewItem"

class ImageLibraryUpload extends Component {
    constructor (props) {
        super(props)

        this.state = {
            selectedFiles: []
        }
    }

    onRemoveFile = (fileIndex) => {
        const selectedFiles = this.state.selectedFiles
        selectedFiles.splice(fileIndex, 1)

        this.setState({ selectedFiles })
    }

    onAddedFiles = (selectedFiles) => {
        this.setState({ selectedFiles: [...this.state.selectedFiles, ...Array.from(selectedFiles)] })
    }

    render () {
        return (
            <div>
                <UploadBox onAddedFiles={this.onAddedFiles}/>
                <PreviewItem selectedFiles={this.state.selectedFiles} onRemoveFile={this.onRemoveFile}/>
            </div>
        )
    }
}

export default ImageLibraryUpload
