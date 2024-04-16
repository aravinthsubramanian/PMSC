<!-- jQuery -->
<script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Feather Icon JS -->
<script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('admin/assets/js/script.js') }}"></script>

<!-- Ck Editor JS -->
<script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>

<!-- Jquery DataTable JS -->
<script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>

<!-- DataTable JS -->
<script src="{{ asset('admin/assets/js/dataTables.bootstrap4.min.js') }}"></script>

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script> --}}

{{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}

{{-- <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script> --}}

<script>
    function myFunction() {
        let inputString = parseFloat($("#cost").val());
        if (!isNaN(inputString)) {
            $('#cost').prop("value", inputString.toFixed(2));
        } else {
            inputString = 0.00;
            $('#cost').prop("value", inputString.toFixed(2));
        }
    }
</script>

<script>
    const toastbox = document.getElementById('toastbox')
    const toastLiveExample = document.getElementById('liveToast')
    if (toastbox) {
        const toast = new bootstrap.Toast(toastLiveExample)
        toast.show()
    }
</script>

{{-- <script type="text/javascript">
    CKEDITOR.replace('wysiwyg-editor', {
        filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script> --}}