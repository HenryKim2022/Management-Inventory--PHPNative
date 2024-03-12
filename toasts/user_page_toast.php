<style>
.code_green {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-success-rgb), var(--bs-bg-opacity)) !important;
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
}

.code_red {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-danger-rgb), var(--bs-bg-opacity)) !important;
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
}

.code_yellow {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important;
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
}

.code_gray {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
}
</style>

<!-- Toast container -->
<div style="position: fixed !important; top: 1rem; right: 1rem; z-index: 999999;">
    <div style="position: absolute; top: 1rem; right: 1rem; z-index: 999999;">
        <!-- Toast -->
        <div class="toast fade sticky-top code_normal" id="toastBasic" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-autohide="false">
            <!-- <div class="toast" id="toastBasic" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="8000"> -->
            <div class="toast-header">
                <i data-feather="bell"></i>
                <strong class="me-auto"> System:</strong>
                <small class="text-muted ms-2">just now</small>
                <button class="ml-2 mb-1 btn-close" type="button" data-bs-dismiss="toast" aria-label="Close">
                </button>
            </div>
            <div class="toast-body">

            </div>
        </div>

    </div>
</div>