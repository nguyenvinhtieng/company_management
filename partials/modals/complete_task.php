<?php
    
    echo '<div class="modal fade" id="modal-complete-task" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Complete Task</h5></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
            <div class="modal-body">
                This task is complete?
                <div class="form-group">
                    <label for="">result</label>
                    <select name="result" id="" required>
                    <option value="">--Choose result--</option>';
        if($day_diff >= 0) {
            echo '<option value="Good">Good</option>';
        }
            echo'
            <option value="OK">OK</option>
            <option value="Bad">Bad</option>
                </select>
                </div>
                
            </div>
            <div class="modal-footer">

                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" name="complete" class="btn btn-primary">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>';

?>