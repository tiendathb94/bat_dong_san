@if(session('message')['text'])
<div class="alert alert-{{ session('message')['status'] }} fs-12">{{ session('message')['text'] }}</div>
@php(session()->forget('message'))
@endif
@push('scripts')
    <script>
        $(document).ready(function() {
          setTimeout(() => {
            $('.alert').addClass('d-none');
          }, 2000)
        })
    </script>
@endpush