import FormSearch from './Components/FormSearch'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showFormSearchComponent () {
        const container = document.getElementById('js-form-search')
        if (container) {
            ReactDOM.render(<FormSearch />, container)
        }
    }

    showFormSearchComponent()
})()