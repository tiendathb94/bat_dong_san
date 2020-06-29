import React, { Component } from 'react'
import PropTypes from 'prop-types'
import classnames from 'classnames'
import Style from './image_library_upload.module.scss'

class PreviewItem extends Component {
    constructor (props) {
        super(props)

        this.state = {}
    }

    static getDerivedStateFromProps (props) {
        return { selectedFiles: props.selectedFiles, uploadedImages: props.uploadedImages }
    }

    onClickRemoveQueueUploadFile (fileIndex) {
        if (this.props.onRemoveFile) {
            this.props.onRemoveFile(fileIndex)
        }
    }

    onClickRemoveUploadedFile (fileId) {
        if (this.props.onRemoveFile) {
            this.props.onRemoveFile(fileId, true)
        }
    }

    onImageLoad = (event, file) => {
        const imgEl = event.target
        const reader = new FileReader()
        reader.addEventListener('load', () => imgEl.setAttribute('src', reader.result))
        reader.readAsDataURL(file)
    }

    displayFileSize (size) {
        const kb = (size / 1024.0).toFixed(2)
        if (kb > 1024) {
            return (kb / 1024.0).toFixed(2) + ' MB'
        }
        return kb + ' KB'
    }

    displayDate (dateTimeString) {
        const date = new Date(dateTimeString)
        return date.toLocaleDateString('vi-VN', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        })
    }

    render () {
        const queuedFiles = this.state.selectedFiles
        const uploadedFiles = this.state.uploadedImages

        return (
            <div className={classnames('container', Style.uploadPreviewWrapper)}>
                {
                    uploadedFiles && uploadedFiles.length > 0 && <div className="row">
                        <div className="col">
                            <div className="row">
                                <h6 className="col mt-3">Hình ảnh đã được tải lên</h6>
                            </div>
                            <div className={classnames(Style.uploadPreviewRowHead, 'row')}>
                                <div className='col col-sm-4 col-md-5'>Ảnh xem trước</div>
                                <div className='col col-sm-4 col-md-5'>Ngày tải lên</div>
                                <div className='col col-sm-4 col-md-2'>Hành động</div>
                            </div>
                        </div>
                    </div>
                }

                {
                    uploadedFiles && uploadedFiles.map((file, i) => (
                        <div key={i} className={classnames(Style.uploadPreviewRow, 'row')}>
                            <div className={classnames(Style.previewImageWrapper, "col col-sm-4 col-md-5")}>
                                <a href={`/storage/${file.file_path}`} target="_blank">
                                    <img src={`/storage/${file.file_path}`}/>
                                </a>
                            </div>
                            <div className="col col-sm-4 col-md-5">{this.displayDate(file.created_at)}</div>
                            <div className={classnames('col col-sm-4 col-md-2', Style.deleteBtn)}>
                                <div onClick={() => this.onClickRemoveUploadedFile(file.id)}>
                                    <span className="ti-trash"></span> Xóa
                                </div>
                            </div>
                        </div>
                    ))
                }

                {/*Queued upload preview*/}
                {queuedFiles && queuedFiles.length > 0 && (
                    <>
                        <div className="row">
                            <h6 className="col mt-3">Hình ảnh đợi tải lên</h6>
                        </div>
                        <div className={classnames(Style.uploadPreviewRowHead, 'row')}>
                            <div className='col col-sm-4 col-md-5'>Ảnh xem trước</div>
                            <div className='col col-sm-4 col-md-5'>Kích thước</div>
                            <div className='col col-sm-4 col-md-2'>Hành động</div>
                        </div>
                    </>
                )}

                {
                    queuedFiles && queuedFiles.map((file, i) => (
                        <div key={i + file.name} className={classnames(Style.uploadPreviewRow, 'row')}>
                            <div className={classnames(Style.previewImageWrapper, "col col-sm-4 col-md-5")}>
                                <img src='' onError={(e) => this.onImageLoad(e, file)}/>
                            </div>
                            <div className="col col-sm-4 col-md-5">{this.displayFileSize(file.size)}</div>
                            <div className={classnames('col col-sm-4 col-md-2', Style.deleteBtn)}>
                                <div onClick={() => this.onClickRemoveQueueUploadFile(i)}>
                                    <span className="ti-trash"></span> Bỏ chọn
                                </div>
                            </div>
                        </div>
                    ))
                }
            </div>
        )
    }
}

PreviewItem.propTypes = {
    selectedFiles: PropTypes.array,
    onRemoveFile: PropTypes.func,
    uploadedImages: PropTypes.array
}

export default PreviewItem
