import React, { Component } from 'react'
import PropTypes from 'prop-types'

class Modal extends Component {
    constructor (props) {
        super(props)

        this.state = { loading: false }
    }

    static getDerivedStateFromProps (props) {
        return { title: props.title, body: props.body }
    }

    onClickHide = () => {
        this.props.onCancel()
    }

    onClickConfirm = async () => {
        if (this.props.loadingOnConfirm) {
            this.setState({ loading: true })
        }

        if (this.props.onConfirm) {
            await this.props.onConfirm()
        }

        if (this.props.loadingOnConfirm) {
            this.setState({ loading: false })
        }
    }

    render () {
        return (
            <div className="modal d-block" tabIndex="-1" role="dialog">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title">{this.state.title}</h5>
                            <button type="button" className="close" onClick={this.onClickHide}>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <p>{this.state.body}</p>
                        </div>
                        <div className="modal-footer">
                            <button
                                type="button"
                                className="btn btn-secondary"
                                data-dismiss="modal"
                                onClick={this.onClickHide}
                                disabled={this.state.loading ? 'disabled' : ''}
                            >
                                Hủy
                            </button>
                            <button
                                type="button"
                                className="btn btn-primary"
                                onClick={this.onClickConfirm}
                                disabled={this.state.loading ? 'disabled' : ''}
                            >
                                {this.state.loading ? 'Vui lòng đợi' : this.props.okLabel || 'Xác nhận'}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

Modal.propTypes = {
    title: PropTypes.string,
    body: PropTypes.string,
    okLabel: PropTypes.string,
    onConfirm: PropTypes.func,
    onCancel: PropTypes.func,
    loadingOnConfirm: PropTypes.bool
}

export default Modal
