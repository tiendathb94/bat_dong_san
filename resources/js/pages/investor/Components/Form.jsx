import React, { Component } from 'react'
import AddressForm from "../../../containers/address_form"
import { Editor } from "react-draft-wysiwyg"
import { EditorState } from "draft-js"

class Form extends Component {
    constructor (props) {
        super(props)

        this.state = {
            EditorState: EditorState.createEmpty()
        }
    }

    render () {
        return (
            <div>
                <div className="row">
                    <div className="col form-group">
                        <label>Tên công ty/doanh nghiệp</label>
                        <input className="form-control" name="name" placeholder="Nhập tên công ty/doanh nghiệp"/>
                    </div>
                </div>

                <div className="row">
                    <div className="col form-group">
                        <label>Website</label>
                        <input className="form-control" name="website" placeholder="Nhập địa chỉ website"/>
                    </div>
                </div>

                <div className="row">
                    <div className="col form-group">
                        <label>Điện thoại liên hệ</label>
                        <input className="form-control" name="phone" type="phone" placeholder="Nhập số điện thoại"/>
                    </div>
                    <div className="col form-group">
                        <label>Địa chỉ email</label>
                        <input className="form-control" name="email" type="email" placeholder="Nhập địa chỉ email"/>
                    </div>
                </div>

                <AddressForm
                    onSync={this.onSyncAddress}
                    required={true}
                />

                <div className="row">
                    <div className="col">
                        <label>Giới thiệu</label>
                        <Editor editorState={this.state.EditorState}/>
                    </div>
                </div>
            </div>
        )
    }
}

export default Form
