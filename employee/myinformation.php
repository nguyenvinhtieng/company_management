<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $department_id_global = $_SESSION['department_id'];
    $my_username = $_SESSION['username'];
    $info = get_my_information($my_username);
    if(isset($_POST['change'])){
        $file = $_FILES['file'];
        $result_upload_file = upload_image($file);
        if($result_upload_file['success']){
            $execute = upload_avatar($my_username, $result_upload_file['path']);
            if($execute['success']){
                $_SESSION['message'] = "Successfully uploaded";
                header("Refresh:0");
                exit();
            }else{
                $global_error = $execute["message"];
            }
        }else{
            $global_error = $result_upload_file["message"];
        }
    }
?>
<?php include '../partials/head.php';?>

<body>
    <div class="layout-container">
        <?php 
            require_once('../partials/header_employee.php');
            echo_header_employee("my_information");
        ?>
        <?php include '../partials/modals/change_pass.php';?>

        <!-- // content page -->

        <section class="department">
            <div class="department-edit">
                <?php include '../partials/show_message.php';?>
                <h3>My information</h3>
                <div class="img-lg label-change-avatar">
                    <img src="../images/<?= $info[0]["avatar_link"] ?>" alt=""/>
                    <div class="change" data-bs-toggle="modal" data-bs-target="#modal-change-avatar">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="camera"
                            class="svg-inline--fa fa-camera fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M512 144v288c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h88l12.3-32.9c7-18.7 24.9-31.1 44.9-31.1h125.5c20 0 37.9 12.4 44.9 31.1L376 96h88c26.5 0 48 21.5 48 48zM376 288c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" disabled value="<?= $info[0]["fullname"] ?>">
                </div>
                <div class="form-group">
                    <label for="">username</label>
                    <input type="text" disabled value="<?= $info[0]["username"] ?>">
                </div>
                <div class="form-group">
                    <label for="">department id</label>
                    <input type="text" disabled value="<?= $info[0]["id"] ?>">
                </div>
                <div class="form-group">
                    <label for="">department name</label>
                    <input type="text" disabled value="<?= $info[0]["name"] ?>">
                </div>
            </div>
        </section>
        <!-- modal change avatar mod -->
        <?php include '../partials/modals/change_avatar.php';?>
        
    </div>
</body>

</html>