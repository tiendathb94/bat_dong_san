import EditForm from './Components/EditForm'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showInfoUserFormComponent () {
        const container = document.getElementById('user-info-form-container')
        if (container) {
            ReactDOM.render(<EditForm/>, container)
        }
    }

    showInfoUserFormComponent()
})()
