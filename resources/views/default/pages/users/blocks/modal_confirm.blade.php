<div class="modal" id="modalDelete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <i class="ti-alert text-danger fs-100"></i>
        <h3 class="my-5">Bạn chắc chắn muốn xóa?</h3>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <form action="" method="POST" id="formDelete">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btnDelete', function () {
                $('#formDelete').attr('action', $(this).data('action'));
                $('#modalDelete').modal('show');
            })
        })
    </script>
@endpush