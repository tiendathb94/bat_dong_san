import EditForm from './Components/EditForm'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showInfoUserFormComponent () {
        const user = typeof window.user === 'object' ? window.user : undefined
        const container = document.getElementById('user-info-form-container')
        if (container) {
            ReactDOM.render(<EditForm user={user} />, container)
        }
    }

    showInfoUserFormComponent()
})()
