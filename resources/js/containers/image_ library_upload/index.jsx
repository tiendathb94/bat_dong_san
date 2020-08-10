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

    async deleteUploadedLibraries () {
        if (!this.state.libraryImagesQueuedToDelete || this.state.libraryImagesQueuedToDelete.length < 1) {
            return
        }

        try {
            await axios.post(`${config.api.baseUrl}/image-library/deletes`, {
                image_library_ids: this.state.libraryImagesQueuedToDelete
            })
        } catch (e) {
            console.error(e)
        }
    }

    // Call from parent component
    async doUpload (libraryableType, libraryableId, libraryType, metaData = []) {
        await this.deleteUploadedLibraries()
        console.log('libraryableId', libraryableId)
        console.log(this.state.selectedFiles)
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

        if (metaData) {
            formData.append('meta_data', metaData)

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
        if(this.props.onRemoveFile) {
            this.props.onRemoveFile(fileId, isUploaded)
        }
    }

    onAddedFiles = (selectedFiles) => {
        this.setState({ selectedFiles: [...this.state.selectedFiles, ...Array.from(selectedFiles)] })
        if(this.props.onAddedFiles) {
            this.props.onAddedFiles(selectedFiles)
        }
    }

    render () {
        return (
            <div>
                <UploadBox onAddedFiles={this.onAddedFiles}/>
                <PreviewItem
                    selectedFiles={this.state.selectedFiles}
                    projectProgressTitleDate={this.props.projectProgressTitleDate}
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
