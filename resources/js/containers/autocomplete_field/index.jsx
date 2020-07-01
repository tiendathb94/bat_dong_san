import React, { Component } from 'react'
import PropTypes from 'prop-types'
import Input from "./input"
import Items from "./items"
import Style from './autocomplete_field.module.scss'

class AutocompleteField extends Component {
    constructor (props) {
        super(props)
        this.state = {
            keyword: '',
            selectedItem: props.selectedItem || {}
        }
    }

    onInputComplete = (keyword) => {
        this.setState({ keyword })
    }

    onSelectItem = (selectedItem) => {
        this.setState({ selectedItem })
        if (this.props.onChange) {
            this.props.onChange(selectedItem.value, selectedItem.name)
        }
    }

    render () {
        return (
            <div className={Style.autocompleteFieldWrapper}>
                <Input
                    onInputComplete={this.onInputComplete}
                    selectedItemName={this.state.selectedItem.name || ''}
                    placeholder={this.props.placeholder}
                />
                <Items emptyValue={this.props.emptyValue} keyword={this.state.keyword} endpoint={this.props.endpoint} onSelectItem={this.onSelectItem}/>
            </div>
        )
    }
}

AutocompleteField.propTypes = {
    endpoint: PropTypes.string,
    onChange: PropTypes.func,
    selectedItem: PropTypes.object,
    placeholder: PropTypes.string,
}

export default AutocompleteField
