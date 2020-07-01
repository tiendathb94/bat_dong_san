import React from 'react'
import ReactDOM from 'react-dom'
import ConfirmModal from "../../containers/confirm_modal"
import axios from 'axios'
import config from "../../config"

(() => {
    function catchAndHandleDeleteInvestorAction () {
        const deleteButtons = document.querySelectorAll('.delete-investor-button')
        const container = document.getElementById('background-react-component-container')

        const onConfirmDeleteInvestor = async (investorId) => {
            try {
                await axios.delete(`${config.api.baseUrl}/investor/${investorId}`)
                window.location.reload()
            } catch (e) {
                if (e.response && e.response.data && e.response.data.message) {
                    alert(e.response.data.message)
                } else {
                    alert('Xóa thông tin chủ đầu tư không thành công vui lòng thử lại')
                }
            }
        }

        deleteButtons.forEach((deleteButton) => {
            deleteButton.addEventListener('click', (event) => {
                event.preventDefault()
                event.stopPropagation()

                const investorId = deleteButton.getAttribute('data-investor-id')
                if (!investorId) {
                    return
                }

                ReactDOM.render(
                    <ConfirmModal
                        title="Bạn có thực sự muốn xóa?"
                        body="Bạn đang chuẩn bị xóa thông tin của một chủ đầu tư, sau khi đã xóa dữ liệu không thể phục hồi."
                        key={investorId}
                        loadingOnConfirm={true}
                        onConfirm={() => onConfirmDeleteInvestor(investorId)}
                    />
                    , container
                )
            })
        })
    }

    // Run here
    catchAndHandleDeleteInvestorAction()
})()
