<?php
    echo '<div class="modal fade" id="modal-approved" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approved application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to approved this application?
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <input type="hidden" id="id_application_approved" name="id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="approved" class="btn btn-primary">Refused</button>
                    </form>
            </div>
        </div>
    </div>
</div>';
?>