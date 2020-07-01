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
            loading: true,
        }
        this.emptyData = { value: '', name: '' }

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
        this.setState({ show: true, loading: true })

        const response = await axios.get(`${config.api.baseUrl}/${this.props.endpoint}?keyword=${this.state.keyword}`)
        this.setState({ data: response.data, loading: false })
    }

    onClickItem (item) {
        this.setState({ show: false })
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
                <div className={Style.itemsWrapper}>
                    {
                        this.state.loading && <div className={Style.loadingWrapper}>
                            <span className="spinner-border"></span> Vui lòng đợi...
                        </div>
                    }

                    {
                        !this.state.loading && this.state.data && this.state.data.length > 0 && <ul>
                            {
                                this.props.selectedItemName && <li key='' onClick={() => this.onClickItem(this.emptyData)} title=''>
                                    <span>Bỏ chọn "{this.props.selectedItemName}"</span>
                                </li>
                            }
                            {
                                this.state.data.map((item) =>
                                    <li key={item.value} onClick={() => this.onClickItem(item)} title={item.name}>
                                        <span>{item.name}</span>
                                    </li>
                                )
                            }
                        </ul>
                    }

                    {
                        !this.state.loading && (!this.state.data || this.state.data.length < 1) &&
                        <div className={Style.loadingWrapper}>
                            Không có mục nào phù hợp
                        </div>
                    }
                </div>
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
