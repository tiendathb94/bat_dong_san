import React, { Component } from 'react'
import classnames from 'classnames'
import PropTypes from 'prop-types'
import LocationInfrastructure from "./layout/LocationInfrastructure"
import CustomContent from "./layout/CustomContent"

class CreateTabButton extends Component {
    constructor (props) {
        super(props)
        this.state = {
            showTabTypes: false,
        }
    }

    getTabContentTypes () {
        return [
            { name: 'Vị trí - Hạ tầng', layout: 'location_infrastructure', component: LocationInfrastructure },
            //{ name: 'Tiến độ dự án', layout: 'project_progress' },
            { name: 'Nội dung tùy chỉnh', layout: 'custom', component: CustomContent },
        ]
    }

    onClickAddMoreTab = () => {
        this.setState({ showTabTypes: !this.state.showTabTypes })
    }

    onClickTabContentType (tabContentType) {
        this.setState({ showTabTypes: false })

        if (this.props.onAddContent) {
            this.props.onAddContent(tabContentType)
        }
    }

    render () {
        return (
            <div className="create-tab-button-wrapper">
                <button className="btn btn-light" onClick={this.onClickAddMoreTab}>
                    <span className={classnames({
                        'ti-minus': this.state.showTabTypes,
                        'ti-plus': !this.state.showTabTypes
                    })}></span> Thêm nội dung nâng cao
                </button>
                {
                    this.state.showTabTypes && <ul className="tab-content-types-wrapper">
                        {
                            this.getTabContentTypes().map((type) => (
                                <li key={type.layout} onClick={() => this.onClickTabContentType(type)}>
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

CreateTabButton.propTypes = {
    onAddContent: PropTypes.func
}

export default CreateTabButton
