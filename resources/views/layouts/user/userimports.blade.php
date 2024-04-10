<!-- jQuery -->
<script src="{{asset('user/assets/js/jquery-3.7.0.min.js')}}"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('user/assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- Fearther JS -->
<script src="{{asset('user/assets/js/feather.min.js')}}"></script>

<!-- Custom JS -->
<script src="{{asset('user/assets/js/script.js')}}"></script>

<!-- Select JS -->
<script src="{{asset('user/assets/plugins/select2/js/select2.min.js')}}"></script>

<!-- Sticky Sidebar JS -->
<script src="{{asset('user/assets/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"></script>
<script src="{{asset('user/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('user/assets/plugins/apexchart/apexcharts.min.js')}}"></script>
<script src="{{asset('user/assets/plugins/apexchart/chart-data.js')}}"></script>
<script src="{{asset('user/assets/plugins/apexchart/line-chart.js')}}"></script>
<script src="{{asset('user/assets/plugins/morris/raphael-min.js')}}"></script>
<script src="{{asset('user/assets/plugins/morris/morris.min.js')}}"></script>

<script>
    const toastbox = document.getElementById('toastbox')
    const toastLiveExample = document.getElementById('liveToast')
    if (toastbox) {
        const toast = new bootstrap.Toast(toastLiveExample)
        toast.show()
    }
</script>
