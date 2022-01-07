<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $department_id_global = $_SESSION['department_id'];
    $my_username = $_SESSION['username'];
    $applications = get_application_of_department($department_id_global);
    if(isset($_POST['refused'])){
        $id = $_POST['id'];
        $is_has = false;
        foreach($applications as $a){
            if($a['id'] == $id && $a['status'] == "waiting") $is_has = true;
        }
        if(!$is_has) $global_error = "Invalid application!";
        else{
            $result_execute = change_status_application($id, "refused");
            if($result_execute['success']){
                $_SESSION['message'] = "Application was refused!";
                header("Refresh:0");
                exit();
            }else{
                $global_error = $result_execute['message'];
            }
        }
    }
    if(isset($_POST['approved'])){
        $id = $_POST['id'];
        $is_has = false;
        foreach($applications as $a){
            if($a['id'] == $id && $a['status'] == "waiting") $is_has = true;
        }
        if(!$is_has) $global_error = "Invalid application!";
        else{
            $result_execute = change_status_application($id, "approved");
            if($result_execute['success']){
                $_SESSION['message'] = "Appplication was approved!";
                header("Refresh:0");
                exit();
            }else{
                $global_error = $result_execute['message'];
            }
        }
    }
?>
<?php include '../partials/head.php';?>
<body>
    <div class="layout-container">
    <?php 
            require_once('../partials/header_manager.php');
            echo_header_manager("application");
        ?>
        <!-- modal change password -->
        <?php include '../partials/modals/change_pass.php';?>
        <!-- // content page -->

        <section class="manage">
            <?php include '../partials/show_message.php';?>
            <div class="manage-heading">
                <h4> Applications</h4>
            </div>

            <div class="manage-content">
                <div class="responsive-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>ID employee</th>
                                <th>Date</th>
                                <th>Reason</th>
                                <th>File attachment</th>
                                <th>Number</th>
                                <th>Status</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($applications as $application){
                                    echo '<tr>';
                                    echo '<td>'.$application['fullname'].'</td>';
                                    echo '<td>'.$application['username'].'</td>';
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
                                    echo '<td> <div class="around '.$application['status'].'">'.$application['status'].'</div></td>';
                                    if($application['status'] == "waiting"){
                                        echo '<td class="table-operation">
                                                <button class="btn-refused refu" data-bs-toggle="modal" data-bs-target="#modal-refused" data-id="'.$application['id'].'">
                                                    refused
                                                </button>
                                                <button class="btn-approved appr" data-bs-toggle="modal"
                                                    data-bs-target="#modal-approved"  data-id="'.$application['id'].'">
                                                    approved
                                                </button>
                                            </td>';
                                    }else{
                                        echo '<td></td>';
                                    }
                                    echo '</tr>';
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <!-- modal refused  -->
        <?php include '../partials/modals/refused_application.php';?>
        

        <!-- modal approved  -->
        <?php include '../partials/modals/approved_application.php';?>
        

    </div>
</body>

</html>