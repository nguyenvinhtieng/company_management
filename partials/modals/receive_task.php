<?php
    echo '<div class="modal fade" id="modal-receive-task" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receive task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to receive this task?
            </div>
            <div class="modal-footer">
            <form action="" method="POST">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="receive" class="btn btn-primary">Receive</button>
                </form>
            </div>
        </div>
    </div>
</div>';
?>