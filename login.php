<?php
    session_start();
    require_once('main.php');
    $global_error = "";

    function redirect_user($data_user, $password){
        $role = $data_user["role"];
        $username = $data_user["username"];
        $_SESSION['role'] = $role;
        if($password == $data_user["username"]){
            $_SESSION['username_temp'] = $username;
            header('Location: ./change_pass.php');
            exit();
        }
        $_SESSION['username'] = $username;
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
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == "")
            $global_error = "Please enter a username";
        else if($password == "")
            $global_error = "Please enter a password";
         else{
            $result_execute = login($username, $password);
            if($result_execute["success"]){
                $data_user = $result_execute["data"];
                redirect_user($data_user, $password);
            }else
                $global_error = $result_execute["message"];
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
                <h1>Login</h1>
                <div class="form-group">
                    <label for="">Username</label>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user"
                        class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                        </path>
                    </svg>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                        class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                        </path>
                    </svg>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <button class="" name="login">Login</button>
                </div>
                
                <?php include './partials/show_message.php';?>
            </form>
        </div>
    </div>
</body>

</html>