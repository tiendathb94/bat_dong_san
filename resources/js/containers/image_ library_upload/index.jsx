import React, { Component } from 'react'
import UploadBox from "./UploadBox"
import PreviewItem from "./PreviewItem"
import PropTypes from 'prop-types'
import axios from "axios"
import config from "../../config"

class ImageLibraryUpload extends Component {
    constructor (props) {
        super(props)

        this.state = {
            selectedFiles: [],
            uploadedImages: props.uploadedImages || [],
            libraryImagesQueuedToDelete: []
        }
    }

    componentDidUpdate (prevProps, prevState, snapshot) {
        if (prevState.selectedFiles.length !== this.state.selectedFiles.length && this.props.onChange) {
            this.props.onChange(this.state.selectedFiles)
        }
    }

    // Call from parent component
    async doUpload (libraryableType, libraryableId, libraryType, metaData = {}) {
        if (!this.state.selectedFiles || !this.state.selectedFiles.length) {
            return
        }

        const formData = new FormData()
        formData.append('libraryable_type', libraryableType)
        formData.append('libraryable_id', libraryableId)
        formData.append('library_type', libraryType)

        for (let i = 0; i < this.state.selectedFiles.length; i++) {
            formData.set(`files[${i}]`, this.state.selectedFiles[i])
        }

        for (const k in metaData) {
            formData.append(`meta_data[${k}]`, metaData[k])
        }

        const response = await axios.post(
            `${config.api.baseUrl}/image-library/uploads`,
            formData,
            {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            },
        )

        return response.data
    }

    onRemoveFile = (fileId, isUploaded) => {
        if (isUploaded) {
            // Remove file uploaded
            const uploadedImages = []
            for (let i = 0; i < this.state.uploadedImages.length; i++) {
                if (this.state.uploadedImages[i].id !== fileId) {
                    uploadedImages.push(this.state.uploadedImages[i])
                }

                this.setState({
                    uploadedImages,
                    libraryImagesQueuedToDelete: [...this.state.libraryImagesQueuedToDelete, fileId]
                })
            }
        } else {
            // Remove new file just selected not uploaded yet
            const selectedFiles = this.state.selectedFiles
            selectedFiles.splice(fileId, 1)

            this.setState({ selectedFiles })
        }
    }

    onAddedFiles = (selectedFiles) => {
        this.setState({ selectedFiles: [...this.state.selectedFiles, ...Array.from(selectedFiles)] })
    }

    render () {
        return (
            <div>
                <UploadBox onAddedFiles={this.onAddedFiles}/>
                <PreviewItem
                    selectedFiles={this.state.selectedFiles}
                    onRemoveFile={this.onRemoveFile}
                    uploadedImages={this.state.uploadedImages}/>
            </div>
        )
    }
}

ImageLibraryUpload.propTypes = {
    onChange: PropTypes.func,
    uploadedImages: PropTypes.array
}

export default ImageLibraryUpload
