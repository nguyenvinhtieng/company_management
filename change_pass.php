<?php
    session_start();
    require_once('main.php');
    $global_error = "";
    $global_message = "Your password is not safe, Please change your password!";
    if(!isset($_SESSION['username_temp'])){
        header('Location: ./login.php');
        exit();
    }
    function redirect_user($username){
        $role = $_SESSION['role'];
        $_SESSION['username'] = $username;
        unset($_SESSION['username_temp']);
        if($role == "admin"){
            header('Location: ./admin/index.php');
            exit();
        }else if($role == "manager"){
            $employee = get_data_employee($username);
            $_SESSION['department_id'] = $employee['department_id'];
            header('Location: ./manager/index.php');
            exit();
        }else if($role == "employee"){
            $employee = get_data_employee($username);
            $_SESSION['department_id'] = $employee['department_id'];
            header('Location: ./employee/index.php');
            exit();
        }
    }

    if(isset($_POST['change_pass'])){
        $global_message = "";
        $conf_password = $_POST['conf_password'];
        $password = $_POST['password'];
        if($password == "") $global_error = "Please enter a password";
        else if($password != $conf_password) $global_error = "Confirm password is not matched";
        else if(strlen($password) < 8) $global_error = "Password must be at least 8 characters";
        else if($password == $_SESSION['username_temp']) $global_error = "Password not alowed matched with username";
        else{
            $result = change_pass_f( $_SESSION["username_temp"], $password);
            if($result['success']){
                redirect_user($_SESSION['username_temp']);
            }else{
                $global_error = "Update password failure";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Programing & Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div class="login">
        <div class="login-form">
            <form method="POST" action="">
                <h1>Change password</h1>
                <div class="form-group">
                    <label for="">New password</label>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                        class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                        </path>
                    </svg>
                    <input type="password" name="password" required>
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
                    <input type="password" name="conf_password" required>
                </div>
                <div>
                    <button class="" name="change_pass">Change</button>
                </div>

                <?php include './partials/show_message.php';?>
            </form>
        </div>
    </div>
</body>

</html>