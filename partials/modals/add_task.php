<?php

    echo '<div class="modal fade" id="modal-add-task" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input type="date" name="deadline" required>
                    </div>
                    <div class="form-group">
                        <label for="">File attachment</label>
                        <input type="file" name="file">
                    </div>
                    <div class="form-group">
                        <label for="">Employee</label>
                        <select name="employee" id="" required>';
            echo '                <option value="">Choose employee</option>';
            foreach($employees as $employee){
                echo '<option value="'.$employee['username'].'">'.$employee['fullname'].' - ' .$employee['username'].'</option>';
            }
                            
            echo '            </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="create" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>'

?>