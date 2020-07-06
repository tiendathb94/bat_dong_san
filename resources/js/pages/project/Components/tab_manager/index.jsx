import React, { Component } from 'react'
import CreateTabButton from "./CreateTabButton"
import TabForm from "./TabForm"
import draftToHtml from 'draftjs-to-html'
import { EditorState, convertToRaw } from 'draft-js'
import classnames from 'classnames'
import PropTypes from 'prop-types'
import Helper from "./Helper"

class TabManager extends Component {
    constructor (props) {
        super(props)

        this.state = {
            tabContents: this.prepareExistTabContents() || [],
            activeTabIndex: 0
        }
    }

    prepareExistTabContents () {
        if (!this.props.tabContents) {
            return []
        }

        const tabContents = []
        for (let i = 0; i < this.props.tabContents.length; i++) {
            const t = this.props.tabContents[i]
            const type = Helper.getTabTypeByLayout(t.layout)

            if (type) {
                tabContents.push({
                    ...this.props.tabContents[i],
                    component: type.component,
                    values: t,
                })
            }
        }

        return tabContents
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
            const tabContentFormRawValues = {
                name: tabContent.name,
                layout: tabContent.layout,
                id: tabContent.id || 0
            }

            if (tabContent.values) {
                const type = Helper.getTabTypeByLayout(tabContent.layout)

                tabContentFormRawValues.contents = {}
                for (const k in tabContent.values) {
                    const value = tabContent.values[k]
                    if (value instanceof EditorState) {
                        tabContentFormRawValues.contents[k] = draftToHtml(convertToRaw(value.getCurrentContent()))
                    } else if (type.contentFields.indexOf(k) >= 0) {
                        tabContentFormRawValues.contents[k] = value
                    }
                }
            }

            tabContentsFormRawValues.push(tabContentFormRawValues)
        })

        return tabContentsFormRawValues
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

TabManager.propTypes = {
    tabContents: PropTypes.array
}

export default TabManager
