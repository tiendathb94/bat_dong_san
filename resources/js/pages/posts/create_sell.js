import Form from './Components/Form'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showProjectFormComponent () {
        const container = document.getElementById('js-form-create-sell-posts')
        if (container) {
            ReactDOM.render(<Form />, container)
        }
    }

    showProjectFormComponent()
})()