import Form from './Components/Form'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showInvestorFormComponent () {
        const investor = typeof window.investor === 'object' ? window.investor : undefined
        const container = document.getElementById('investor-form-container')
        if (container) {
            ReactDOM.render(<Form investor={investor}/>, container)
        }
    }

    showInvestorFormComponent()
})()
