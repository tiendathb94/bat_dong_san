import React, { Component } from 'react'
import CreateTabButton from "./CreateTabButton"
import TabForm from "./TabForm"
import classnames from 'classnames'

class TabManager extends Component {
    constructor (props) {
        super(props)

        this.state = {
            tabContents: [],
            activeTabIndex: 0
        }
    }

    onAddTabContent = (tabContentType) => {
        const tabContents = this.state.tabContents
        tabContents.push(tabContentType)
        this.setState({ tabContents, activeTabIndex: tabContents.length - 1 })
    }

    onClickChangeActiveTabContent (activeTabIndex) {
        this.setState({ activeTabIndex })
    }

    onChangeTabContentName (tabIndex, name) {
        const tabContents = this.state.tabContents
        tabContents[tabIndex].name = name
        this.setState({ tabContents })
    }

    setTabContentValues (tabIndex, values) {
        const tabContents = this.state.tabContents
        tabContents[tabIndex].values = values
        this.setState({ tabContents })
    }

    getTabContentsFormRawValues () {
        const tabContentsFormRawValues = []
        this.state.tabContents.forEach((tabContent) => {
            const tabContentFormRawValues = { name: tabContent.name, layout: tabContent.layout }
        })
    }

    render () {
        return (
            <div className="mt-3">
                <div className="tab-content-button-wrapper">
                    {this.state.tabContents.map((tab, k) => (
                        <button
                            key={k}
                            className={classnames({
                                'btn btn-info': true,
                                active: this.state.activeTabIndex === k,
                                'not-active': this.state.activeTabIndex !== k,
                            })}
                            onClick={() => this.onClickChangeActiveTabContent(k)}
                        >
                            <span className="ti-layers-alt mr-2"></span>
                            {tab.name}
                        </button>
                    ))}

                    <CreateTabButton onAddContent={this.onAddTabContent}/>
                </div>

                {
                    this.state.tabContents.length > 0 &&
                    <TabForm
                        tabContent={this.state.tabContents[this.state.activeTabIndex]}
                        onChangeTabName={(name) => this.onChangeTabContentName(this.state.activeTabIndex, name)}
                        onChangeTabValues={(values) => this.setTabContentValues(this.state.activeTabIndex, values)}
                        key={this.state.activeTabIndex}
                    />
                }
            </div>
        )
    }
}

export default TabManager
