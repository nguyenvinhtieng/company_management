<?php
    echo '<div class="modal fade" id="modal-change-avatar" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change my avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="">avatar</label>
                        <input type="file" id="avatar" name="file" required accept="image/*">
                    </div>
                    <div class="img-lg mt-3">
                        <img src="../images/'.$info[0]["avatar_link"].'" alt="" id="avatar-preview">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="change" class="btn btn-primary">Save changes</button>
                </form>

            </div>
        </div>
    </div>
</div>';
?>