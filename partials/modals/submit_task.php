<?php
    echo '<div class="modal fade" id="modal-submit-task" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=""  enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="">content</label>
                        <textarea name="content" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">file attachment</label>
                        <input type="file" name="file" >
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>';
?>