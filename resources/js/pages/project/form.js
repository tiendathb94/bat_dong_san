import Form from './Components/Form'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showProjectFormComponent () {
        const project = typeof window.project === 'object' ? window.project : undefined
        const container = document.getElementById('project-form-container')
        if (container) {
            ReactDOM.render(<Form project={project}/>, container)
        }
    }

    showProjectFormComponent()
})()
