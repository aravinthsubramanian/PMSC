@if (session()->has('success'))
    <div class="toast-container position-fixed top-5 end-0 p-3" id="toastbox">
        <div class="toast text-bg-success" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

@if (session()->has('warning'))
    <div class="toast-container position-fixed top-5 end-0 p-3" id="toastbox">
        <div class="toast text-bg-warning" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {{ session('warning') }}
            </div>
        </div>
    </div>
@endif

@if (session()->has('message'))
    <div class="toast-container position-fixed top-5 end-0 p-3" id="toastbox">
        <div class="toast text-bg-warning" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif

@if (session()->has('danger'))
    <div class="toast-container position-fixed top-5 end-0 p-3" id="toastbox">
        <div class="toast text-bg-danger" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {{ session('danger') }}
            </div>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="toast-container position-fixed top-5 end-0 p-3" id="toastbox">
        <div class="toast text-bg-danger" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif
