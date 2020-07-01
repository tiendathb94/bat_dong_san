import React from 'react'
import ReactDOM from 'react-dom'
import ConfirmModal from "../../containers/confirm_modal"
import axios from 'axios'
import config from "../../config"

(() => {
    function catchAndHandleDeleteProjectAction () {
        const deleteButtons = document.querySelectorAll('.delete-project-button')
        const container = document.getElementById('background-react-component-container')

        if (!deleteButtons || !container) {
            return
        }

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

    function catchAndHandleApproveOrDeclineProjectAction () {
        const approveButtons = document.querySelectorAll('.approve-project-button')
        const declineButtons = document.querySelectorAll('.decline-project-button')
        const container = document.getElementById('background-react-component-container')

        if (!declineButtons || !approveButtons || !container) {
            return
        }

        const onConfirm = async (projectId, action) => {
            try {
                await axios.post(`${config.api.baseUrl}/project/${projectId}/${action}`)
                window.location.reload()
            } catch (e) {
                if (e.response && e.response.data && e.response.data.message) {
                    alert(e.response.data.message)
                } else {
                    alert('Cập nhật trạng thái dự án không thành công vui lòng thử lại.')
                }
            }
        }

        const handleClickEvent = (event) => {
            event.preventDefault()
            event.stopPropagation()

            const projectId = event.target.getAttribute('data-project-id')
            if (!projectId) {
                return
            }

            const action = event.target.getAttribute('data-action')
            if (!action) {
                return
            }

            ReactDOM.render(
                <ConfirmModal
                    title={action === 'approve' ? 'Bạn sắp duyệt một dự án' : 'Bạn sắp từ chối một dự án'}
                    body={
                        action === 'approve' ?
                            'Dự án được duyệt sẽ hiển thị ra ngoài website và tất cả khách truy cập có thể tìm thấy và nhìn thấy dự án này.' :
                            'Dự án bị từ chối sẽ không được hiển thị ra ngoài website và không ai có thể nhìn thấy nó ngoại trừ người đăng.'
                    }
                    key={`action-${projectId}`}
                    loadingOnConfirm={true}
                    onConfirm={() => onConfirm(projectId, action)}
                />
                , container
            )
        }

        approveButtons.forEach((btn) => btn.addEventListener('click', handleClickEvent))
        declineButtons.forEach((btn) => btn.addEventListener('click', handleClickEvent))
    }

    // Run here
    catchAndHandleDeleteProjectAction()
    catchAndHandleApproveOrDeclineProjectAction()
})()
