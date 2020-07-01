import ProjectField from './Components/ProjectField'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showProjectFieldComponent () {
        const requestOld = typeof window.requestOld === 'object' ? window.requestOld : undefined
        const container = document.getElementById('js-get-project-id')
        if (container) {
            ReactDOM.render(<ProjectField request={requestOld} />, container)
        }
    }

    showProjectFieldComponent()
})()