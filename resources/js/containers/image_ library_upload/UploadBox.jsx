import React, { Component } from 'react'
import classnames from 'classnames'
import Style from './image_library_upload.module.scss'
import PropTypes from 'prop-types'

class UploadBox extends Component {
    constructor (props) {
        super(props)

        this.fileInputRef = React.createRef()

        this.state = {
            dragging: false
        }
    }

    onDragIn = (e) => {
        e.preventDefault()
        e.stopPropagation()

        this.setState({ dragging: true })
    }

    onDrag = (e) => {
        e.preventDefault()
        e.stopPropagation()
        this.setState({ dragging: true })
    }

    onDragOut = (e) => {
        e.preventDefault()
        e.stopPropagation()

        this.setState({ dragging: false })
    }

    onDrop = (e) => {
        e.preventDefault()
        e.stopPropagation()
        this.setState({ dragging: false })
        if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
            this.handleAddFile(e.dataTransfer.files)
        }
    }

    onClickBrowseLocalFile = () => {
        this.fileInputRef.current.click()
    }

    onFileInputChanged = (e) => {
        if (e.target.files && e.target.files.length > 0) {
            this.handleAddFile(e.target.files)
        }
    }

    handleAddFile (files) {
        if (this.props.onAddedFiles) {
            this.props.onAddedFiles(files)
        }
    }

    render () {
        return (
            <div
                className={classnames({ [Style.uploadBoxWrapper]: true, [Style.dragging]: this.state.dragging })}
                onDragEnter={this.onDragIn}
                onDragLeave={this.onDragOut}
                onDragOver={this.onDrag}
                onDrop={this.onDrop}
            >
                <svg id="_x31_px" height="100" viewBox="0 0 24 24" width="100" fill="#ccc">
                    <path
                        d="m13.5 23h-3c-.552 0-1-.449-1-1v-5h-2.5c-.202 0-.385-.122-.462-.309s-.034-.402.108-.545l5-5c.195-.195.512-.195.707 0l5 5c.143.143.186.358.108.545s-.259.309-.461.309h-2.5v5c0 .551-.448 1-1 1zm-5.293-7h1.793c.276 0 .5.224.5.5v5.5h3v-5.5c0-.276.224-.5.5-.5h1.793l-3.793-3.793z"/>
                    <path
                        d="m4.501 16.97c-.019 0-.037-.001-.057-.003-2.533-.281-4.444-2.417-4.444-4.967 0-2.642 2.059-4.811 4.656-4.988.692-3.456 3.777-6.012 7.344-6.012 2.801 0 5.381 1.578 6.653 4.044 3.022.317 5.347 2.878 5.347 5.956 0 2.68-1.796 5.05-4.366 5.762-.268.073-.542-.083-.615-.349-.074-.266.082-.542.348-.615 2.139-.592 3.633-2.566 3.633-4.798 0-2.647-2.063-4.835-4.697-4.981-.185-.01-.348-.121-.426-.288-1.058-2.266-3.364-3.731-5.877-3.731-3.215 0-5.977 2.395-6.425 5.57-.035.246-.246.43-.495.43-2.286 0-4.08 1.794-4.08 4 0 2.04 1.528 3.748 3.556 3.973.274.031.472.278.441.552-.028.256-.245.445-.496.445z"/>
                </svg>

                <p className={Style.uploadDragDropHeading}>Kéo thả hình ảnh vào đây</p>
                <p className="mb-5">hoặc</p>
                <button className="btn btn-outline-primary" onClick={this.onClickBrowseLocalFile}>
                    <span className="ti-harddrives small"></span> Chọn từ thư mục
                </button>

                <input type="file" hidden multiple accept="image/*" ref={this.fileInputRef}
                       onChange={this.onFileInputChanged}/>
            </div>
        )
    }
}

UploadBox.propTypes = {
    onAddedFiles: PropTypes.func
}

export default UploadBox
