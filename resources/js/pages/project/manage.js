import React from 'react'
import ReactDOM from 'react-dom'
import ConfirmModal from "../../containers/confirm_modal"
import axios from 'axios'
import config from "../../config"

(() => {
    function catchAndHandleDeleteProjectAction () {
        const deleteButtons = document.querySelectorAll('.delete-project-button')
        const container = document.getElementById('background-react-component-container')

        const onConfirmDeleteProject = async (projectId) => {
            try {
                await axios.delete(`${config.api.baseUrl}/project/${projectId}`)
                window.location.reload()
            } catch (e) {
                if (e.response && e.response.data && e.response.data.message) {
                    alert(e.response.data.message)
                } else {
                    alert('Xóa dự án không thành công vui lòng thử lại')
                }
            }
        }

        deleteButtons.forEach((deleteButton) => {
            deleteButton.addEventListener('click', (event) => {
                event.preventDefault()
                event.stopPropagation()

                const projectId = deleteButton.getAttribute('data-project-id')
                if (!projectId) {
                    return
                }

                ReactDOM.render(
                    <ConfirmModal
                        title="Chuẩn bị xóa một dự án"
                        body="Bạn có chắc chắn muốn xóa dự án này không sau khi xóa sẽ không thể phục hồi"
                        key={projectId}
                        loadingOnConfirm={true}
                        onConfirm={() => onConfirmDeleteProject(projectId)}
                    />
                    , container
                )
            })
        })
    }

    // Run here
    catchAndHandleDeleteProjectAction()
})()
