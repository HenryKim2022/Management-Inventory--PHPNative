<!-- Toast container -->
<div style="position: sticky !important; top: 1rem; right: 1rem; z-index: 999999;">
    <div style="position: absolute; top: 1rem; right: 1rem; z-index: 999999;">
        <!-- Toast -->
        <div class="toast fade" id="toastBasic" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="false">
            <!-- <div class="toast" id="toastBasic" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="8000"> -->
            <div class="toast-header">
                <i data-feather="bell"></i>
                <strong class="me-auto"> System:</strong>
                <small class="text-muted ms-2">just now</small>
                <button class="ml-2 mb-1 btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"> </button>
            </div>
            <div class="toast-body"></div>
        </div>

        <div class="toast fade" id="toastBasic2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted ms-2">2 seconds ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>

        <div class="toast fade" id="toastBasic3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted ms-2">2 seconds ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>
</div>





<!-- JS DEPEDENCY'S -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous">
</script>
<script type="text/javascript" src="dist/js/toasts.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/components/prism-core.min.js"
    crossorigin="anonymous">
</script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/plugins/autoloader/prism-autoloader.min.js"
    crossorigin="anonymous"></script>


<!-- Put near end of all js -->
<script type="text/javascript">
$("#toastBasicTrigger").on("click", function(e) {
    e.preventDefault();
    $("#toastBasic .toast-body").text("TESTING TOAST!");
    $("#toastBasic").toast({
        autohide: false
    });
    $("#toastBasic").toast("show");
    setTimeout(function() {
        $("#toastBasic2 .toast-body").text("SECOND MESSAGE");
        $("#toastBasic2").toast("show");
    }, 3000); // 3000 milliseconds (3 seconds) delay 
    setTimeout(function() {
        $("#toastBasic3 .toast-body").text("THIRD MESSAGE");
        $("#toastBasic3").toast("show");
    }, 6000); // 6000 milliseconds (6 seconds) delay // and so on... 
});