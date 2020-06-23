import CreateForm from './Components/CreateForm'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showCreateProjectFormComponent () {
        const container = document.getElementById('project-create-form-container')
        if (container) {
            ReactDOM.render(<CreateForm/>, container)
        }
    }

    showCreateProjectFormComponent()
})()
