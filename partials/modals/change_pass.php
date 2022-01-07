<?php   
    if(isset($_POST['change-pass'])){
        $cur = $_POST['curr_pass'];
        $new = $_POST['new_pass'];
        $conf = $_POST['conf_pass'];
        if($cur == "") $global_error = "Please enter a current password";
        else if($new == "") $global_error = "Please enter a new password";
        else if($conf == "") $global_error = "Please enter a confirm password";
        else if($new != $conf) $global_error = "Confirm password not matched";
        else if(strlen($new) < 8) $global_error = "Password need more than 8 characters";
        else{
            $result = change_pass($_SESSION['username'], $cur, $new);
            if($result['success']){
                $global_message = $result['message'];
            }else{
                $global_error = $result['message'];
            }
        }
    }

    echo '<div class="modal fade" id="modal-change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change password account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Current password</label>
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                            class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                            </path>
                        </svg>
                        <input type="password" name="curr_pass" required>
                    </div>
                    <div class="form-group">
                        <label for="">New password</label>
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                            class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                            </path>
                        </svg>
                        <input type="password" name="new_pass" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm password</label>
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                            class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                            </path>
                        </svg>
                        <input type="password" name="conf_pass" required>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="change-pass" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>';
?>