import React, { Component } from 'react'
import PropTypes from 'prop-types'
import Modal from "./modal"
import ReactDom from 'react-dom'

class ConfirmModal extends Component {
    constructor (props) {
        super(props)
        this.wrapperEl = React.createRef()

        this.state = {
            wrapperStyle: {}
        }
    }

    static getDerivedStateFromProps (props) {
        return { title: props.title, body: props.body }
    }

    hide () {
        this.setState({
            wrapperStyle: {
                opacity: 0,
                transition: 'all 0.4s ease'
            }
        })

        setTimeout(() => ReactDom.unmountComponentAtNode(this.wrapperEl.current.parentElement), 420)
    }

    onCancel = () => {
        this.hide()
    }

    onConfirm = async () => {
        if (this.props.onConfirm) {
            if (this.props.loadingOnConfirm) {
                await this.props.onConfirm()
            } else {
                this.props.onConfirm()
            }
        }

        this.hide()
    }

    render () {
        return (
            <div ref={this.wrapperEl} style={this.state.wrapperStyle}>
                <Modal
                    title={this.state.title}
                    body={this.state.body}
                    okLabel={this.props.okLabel}
                    onCancel={this.onCancel}
                    onConfirm={this.onConfirm}
                    loadingOnConfirm={this.props.loadingOnConfirm}
                />

                <div className="modal-backdrop show"></div>
            </div>
        )
    }
}

Modal.propTypes = {
    title: PropTypes.string,
    body: PropTypes.string,
    okLabel: PropTypes.string,
    onConfirm: PropTypes.func,
    loadingOnConfirm: PropTypes.bool
}

export default ConfirmModal
