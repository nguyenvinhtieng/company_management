<?php
    echo '<div class="modal fade" id="modal-reset-pass" tabindex="-1" role="" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to reset password for this account?
            </div>
            <div class="modal-footer">
            <form class="" method="post" action="">
            <input type="hidden" id="username_user" name="username">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="reset" class="btn btn-danger">Reset</button>
            </form>
            </div>
        </div>
    </div>
</div>';
?>