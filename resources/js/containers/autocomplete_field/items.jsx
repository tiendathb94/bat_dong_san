import React, { Component } from 'react'
import PropTypes from 'prop-types'
import axios from 'axios'
import config from "../../config"
import Style from './autocomplete_field.module.scss'

class Items extends Component {
    constructor (props) {
        super(props)
        this.state = {
            data: [],
            show: false,
            loading: false,
        }

        this.node = React.createRef()
    }

    static getDerivedStateFromProps (props) {
        return { keyword: props.keyword }
    }

    async componentDidUpdate (prevProps, prevState, snapshot) {
        if (prevState.keyword !== this.state.keyword) {
            await this.fetchData()
        }

        if (this.state.show && !this.initiatedEvents) {
            this.initiatedEvents = true
            const parentEl = this.node.current.parentElement

            // Start searching
            parentEl.getElementsByTagName('input')[0].addEventListener('focus', () => {
                if (this.state.data && this.state.data.length) {
                    this.setState({ show: true })
                }
            })

            // Click outside
            document.addEventListener('click', (event) => {
                if (!this.state.show) {
                    return
                }

                if (!parentEl.contains(event.target) && !parentEl.contains(event.target.parentElement)) {
                    this.setState({ show: false })
                }
            })
        }
    }

    async fetchData () {
        if (!this.state.keyword || this.state.keyword.length < 1) {
            this.setState({ data: [] })
            return
        }

        const response = await axios.get(`${config.api.baseUrl}/${this.props.endpoint}?keyword=${this.state.keyword}`)
        this.setState({ data: response.data, show: true })
    }

    onClickItem (item) {
        if (this.props.onSelectItem) {
            this.props.onSelectItem(item)
        }
    }

    render () {
        if (!this.state.show) {
            return ''
        }

        return (
            <div ref={this.node}>
                {
                    this.state.data && this.state.data.length > 0 && <ul className={Style.itemsWrapper}>
                        {
                            this.state.data.map((item) =>
                                <li key={item.value} onClick={() => this.onClickItem(item)} title={item.name}>
                                    <span>{item.name}</span>
                                </li>
                            )
                        }
                    </ul>
                }
            </div>
        )
    }
}

Items.propTypes = {
    keyword: PropTypes.string,
    endpoint: PropTypes.string,
    onSelectItem: PropTypes.func,
}

export default Items
