import EditorField from './Components/EditorField'
import React from 'react'
import ReactDOM from 'react-dom'

(() => {
    function showEditorComponent () {
        const container = document.getElementById('editor-content')
        if (container) {
            ReactDOM.render(<EditorField />, container)
        }
    }

    showEditorComponent()
})()