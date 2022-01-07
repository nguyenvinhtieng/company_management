<?php
    if (isset($_SESSION['username'])) {
        $path_role = explode('/',$_SERVER['REQUEST_URI'])[2];
        if($path_role != $_SESSION['role']){
            header('Location: ../login.php');
            exit();
        }
    }
    else if(isset($_SESSION['username_temp'])) {
        header('Location: ../change_pass.php');
        exit();
    } else{
        header('Location: ../login.php');
        exit();
    }
?>