import Form from './Components/Form'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showInvestorFormComponent () {
        const container = document.getElementById('investor-form-container')
        if (container) {
            ReactDOM.render(<Form/>, container)
        }
    }

    showInvestorFormComponent()
})()
