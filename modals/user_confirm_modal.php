<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDelUserLogin" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button id="modal-close-btn" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center align-content-end">
                <p>R'u sure that you want to delete your own record?</p>
                <p>U'll never be able to login using this account anymore if data deletion was successfull and U'll
                    logged
                    out
                    automatically from your account after
                    confirming "CONTINUE DELETE"
                    <span class="far fa-grin-beam-sweat fa-lg"></span>
                </p>
                <p class="text-center align-items-md-end">
                    <span id="countdown"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button id="modal-cancel-btn" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <a id="modal-continue-btn" href="#" class="btn btn-danger">Continue Delete</a>

                <!-- <a id="modal-continue-btn" href="?= $modal_act_url ?>" class="btn btn-danger">Continue Delete</a> -->
                <!-- <a id="modal-continue-btn" href="?= "/fungsi/ulogins_funct.php?act=del&unik=" . $res['NIK']; ?>" class="btn btn-danger">Continue Delete</a> -->
            </div>
        </div>
    </div>
</div>