<?php
    echo '<div class="modal fade" id="modal-see-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Employee information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-lg">
                    <img src="../images/avatar.png" id="avatar" alt="">
                </div>
                <div>
                    <div class="form-group">
                        <label for="">username</label>
                        <input type="text" value="" id="username" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">fullname</label>
                        <input type="text" value="" id="name" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">department id</label>
                        <input type="text" value="" id="department-id" disabled="disabled"">
                    </div>
                    <div class="form-group">
                        <label for="">department name</label>
                        <input type="text" value="" id="department-name" disabled="disabled"  disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">position</label>
                        <input type="text" value="" id="position" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>';
?>