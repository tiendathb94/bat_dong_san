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
        return { selectedFiles: props.selectedFiles }
    }

    onClickRemoteFile (fileIndex) {
        if (this.props.onRemoveFile) {
            this.props.onRemoveFile(fileIndex)
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
    };

    render () {
        const files = this.state.selectedFiles

        return (
            <div className={classnames('container', Style.uploadPreviewWrapper)}>
                {files && files.length > 0 && (
                    <div className={classnames(Style.uploadPreviewRowHead, 'row')}>
                        <div className='col col-sm-4 col-md-5'>Ảnh preview</div>
                        <div className='col col-sm-4 col-md-5'>Kích thước</div>
                        <div className='col col-sm-4 col-md-2'>Hành động</div>
                    </div>
                )}

                {
                    files && files.map((file, i) => (
                        <div key={i + file.name} className={classnames(Style.uploadPreviewRow, 'row')}>
                            <div className={classnames(Style.previewImageWrapper, "col col-sm-4 col-md-5")}>
                                <img src='' onError={(e) => this.onImageLoad(e, file)}/>
                            </div>
                            <div className="col col-sm-4 col-md-5">{this.displayFileSize(file.size)}</div>
                            <div className={classnames('col col-sm-4 col-md-2', Style.deleteBtn)}>
                                <div onClick={() => this.onClickRemoteFile(i)}>
                                    <span className="ti-trash"></span> Xóa
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
}

export default PreviewItem
