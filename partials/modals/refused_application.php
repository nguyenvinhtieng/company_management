<?php
    echo '<div class="modal fade" id="modal-refused" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refused application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to refused this application?
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <input type="hidden" id="id_application_refused" name="id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="refused" class="btn btn-danger">Refused</button>
                </form>
            </div>
        </div>
    </div>
</div>';
?>