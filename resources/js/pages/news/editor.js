import EditorField from './Components/EditorField'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showEditorComponent () {
        const requestOld = typeof window.requestOld === 'object' ? window.requestOld : undefined
        const container = document.getElementById('editor-content')
        if (container) {
            ReactDOM.render(<EditorField request={requestOld} />, container)
        }
    }

    showEditorComponent()
})()