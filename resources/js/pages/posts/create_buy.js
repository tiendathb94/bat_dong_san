import Form_Create_Buy from './Components/Form_Create_Buy'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showProjectFormCreateBuyComponent () {
        const container = document.getElementById('js-form-create-buy-posts')
        if (container) {
            ReactDOM.render(<Form_Create_Buy />, container)
        }
    }

    showProjectFormCreateBuyComponent()
})()