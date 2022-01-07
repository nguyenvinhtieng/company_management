<?php
    $departments = get_departments();
    echo '<div class="modal fade" id="modal-add-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">username</label>
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user"
                            class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                            </path>
                        </svg>
                        <input type="text" name="username" required >
                    </div>
                    <div class="form-group">
                        <label for="">fullname</label>
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user"
                            class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                            </path>
                        </svg>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Department</label>
                        <select name="department_id" required>
                        <option value="">Select department</option>';
    foreach($departments as $department){
        echo '<option value="'.$department['id'].'">'.$department['name'].'</option>';
    }
                        echo '</select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="create" class="btn btn-primary">Create</button>
            </div>
        </div>
        </form>
    </div>
</div>';
?>