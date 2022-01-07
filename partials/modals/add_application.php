<?php

    echo '<div class="modal fade" id="modal-add-application" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST" >
                    <div class="form-group">
                        <label for="">Reason</label>
                        <textarea name="reason" id="" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Number day</label>
                        <select name="number" required>
                            <option value="">--Chosse number day--</option>';
                    for ($i = 1; $i <= $number_day_left ; $i ++){
                        echo '<option value="'.$i.'"> '.$i.' </option> ';
                    }
                    echo '  </select>
                    </div>
                    <div class="form-group">
                        <label for="">File attachment</label>
                        <input type="file" name="file">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="create" class="btn btn-primary">Create</button>
            </div>
            </form>

        </div>
    </div>
</div>';
?>