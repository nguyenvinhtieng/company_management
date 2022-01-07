<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $department_id_global = $_SESSION['department_id'];
    $my_username = $_SESSION['username'];
    $number_day_left = count_number_day_left($my_username, $_SESSION['role']);
    $number_day_need_wait = count_number_day_need_wait($my_username);
    $applications = get_my_application($my_username);
    if(isset($_POST['create'])){
        $reason = $_POST['reason'];
        $number = $_POST['number'];
        $file = $_FILES['file'];
        if($number == 0 || $number == "") $global_error = "Number day is required";
        else if($number > $number_day_left) $global_error = "You want more day left. We not allowed :)";
        else if($number_day_need_wait > 0) $global_error = "You need wait to add new application!";
        else{
            $file_name_result = upload_file($file);
            if($file_name_result['success']){
                $file_name = $file_name_result['path'];
                $result_exe = add_application($my_username, $number, $_SESSION['role'], $reason, $file_name, $department_id_global);
                if($result_exe['success']){
                    $_SESSION["message"] = $result_exe['message'];
                    header("Refresh:0");
                    exit();
                }else{
                    $global_error = $result_exe['message'];
                }
            }else{
                $global_error = $file_name_result['message'];
            }
        }
    }
?>
<?php include '../partials/head.php';?>
<body>
    <div class="layout-container">
        <?php 
            require_once('../partials/header_manager.php');
            echo_header_manager("my_application");
        ?>
        <!-- modal change password -->
        <?php include '../partials/modals/change_pass.php';?>
        <!-- // content page -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        echo 'You have '.$number_day_left.' days off this year ';
                        echo '</br>';
                        echo '</br>';
                        if($number_day_need_wait == 0) {
                            echo 'You can create a new application now!';
                        }else{
                            echo 'You need wait '.$number_day_need_wait.' days to create a new application!';
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
            </div>
        <section class="manage">
            <?php include '../partials/show_message.php';?>
            <div class="manage-heading">
                <h4> My application 
                    <?php
                        if($number_day_need_wait > 0 || $number_day_left == 0) {

                        }else{
                            echo '<button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-add-application">Add
                            new </button> ';
                        }
                    ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">  See
                            </button>      
</h4>
            </div>

            <div class="manage-content">
                <div class="responsive-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Id application</th>
                                <th>Date</th>
                                <th>Reason</th>
                                <th>File attachment</th>
                                <th>Number</th>
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($applications as $application){
                                    echo '<tr>';
                                    echo '<td>'.$application['id'].'</td>';
                                    echo '<td>'.$application['date'].'</td>';
                                    echo '<td>'.$application['reason'].'</td>';
                                    echo '<td>';
                                    if($application['file'] != '')
                                        echo '<a class="" target="_blank" 
                                        href="../download.php?path='.$application['file'].'">
                                            '.$application['file'].'
                                        </a> ';
                                    echo '</td>';
                                    echo '<td>'.$application['number'].'</td>';
                                    echo '<td>';
                                        echo '<div class="around '.$application['status'].'" >';
                                        echo $application['status'];
                                        echo '</div>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <!-- modal add application  -->
        <?php include '../partials/modals/add_application.php';?>
        

    </div>
</body>

</html>