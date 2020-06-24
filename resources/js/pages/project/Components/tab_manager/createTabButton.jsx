import React, { Component } from 'react'

class CreateTabButton extends Component {
    constructor (props) {
        super(props)
        this.state = {
            showTabTypes: false,
        }
    }

    getTabContentTypes () {
        return [
            { name: 'Vị trí - Hạ tầng', layout: 'location_infrastructure' },
            { name: 'Tiến độ dự án', layout: 'project_progress' },
            { name: 'Nội dung tùy chỉnh', layout: 'custom' },
        ]
    }

    onClickAddMoreTab = () => {
        this.setState({ showTabTypes: !this.state.showTabTypes })
    }

    render () {
        return (
            <div>
                <button className="btn btn-info" onClick={this.onClickAddMoreTab}>
                    <span className="ti-plus"></span> Thêm nội dung
                </button>
                {
                    this.state.showTabTypes && <ul className="tab-content-types-wrapper">
                        {
                            this.getTabContentTypes().map((type) => (
                                <li key={type.layout}>
                                    <span className="ti-layers-alt"></span> {type.name}
                                </li>
                            ))
                        }
                    </ul>
                }
            </div>
        )
    }
}

export default CreateTabButton
