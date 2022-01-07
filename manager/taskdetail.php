<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $department_id_global = $_SESSION['department_id'];
    $my_username = $_SESSION['username'];
    $params = get_params(); 
    try{
        $task_id = (int) $params['id'];
        $task = get_task($task_id);
        if(count($task) == 0){
            header('Location: ./index.php');
            exit();
        }
        $task_histories = get_task_histories($task_id);
    }catch(Exception $err){
        header('Location: ./index.php');
        exit();
    }
    $last_time_submit_task = end($task_histories);
    $day_diff = date_diff_mycustom($last_time_submit_task["time"] ?? "", $task[0]["deadline"] ?? "");
    $task_of_department = get_task_of_department($department_id_global); 
    $is_has = false;
    foreach($task_of_department as $task_item){
        if($task_item['id'] == $task_id) $is_has = true;
    }
    if(!$is_has){
        header('Location: ./index.php');
        exit();
    }
    if(isset($_POST['complete'])){
        $result = $_POST['result'];
        if($result == "") $global_result = "Please choose result for this task";
        else if($result == "Good" && $day_diff < 0) $global_error ="Result not valid!";
        else if($task[0]['status'] == "Waiting"){
            $ontime = "late";
            if($day_diff > 0) $ontime = "on time";
            $result_execute = complete_task($task_id, "Completed", $ontime, $result);
            if($result_execute['success']){
                $global_message = "Task completed!";  
                header('Location: ./index.php');
                exit();
            }else{
                $global_error = $result_execute['message'];
            }
        }else{
            $global_error = "Invalid action";
        }
    }

    if(isset($_POST['reject'])){
        $content = $_POST['content'];
        $deadline = $_POST['deadline'];
        $file = $_FILES['file'];
        if($content == "") $global_error = "Content can not be empty";
        else{
            $file_name_result = upload_file($file);
            if($file_name_result['success']){
                $file_name = $file_name_result['path'];
                $result_exe = reject_task($file_name,$content, $deadline,$task_id);
                if($result_exe["success"]){
                    $global_message = $result_exe['message'];
                    header('Location: ./index.php');
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
            echo_header_manager("task");
        ?>
        <!-- modal change password -->
        <?php include '../partials/modals/change_pass.php';?>
        <!-- // content page -->

        <section class="task">
            
            <div class="task-detail">
                <?php include '../partials/show_message.php';?>
                <h3>Task detail
                    <span class="around <?= $task[0]['status'] ?>"><?= $task[0]['status'] ?></span>
                </h3>
                <div class="form-group">
                    <label for="">title</label>
                    <input type="text" value="<?= $task[0]['title'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">description</label>
                    <textarea type="text" disabled><?= $task[0]['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Employee id</label>
                    <input type="text" value="<?= $task[0]['employee_id'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Employee name</label>
                    <input type="text" value="<?= $task[0]['fullname'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Deadline</label>
                    <input type="text" value="<?= $task[0]['deadline'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Result</label>
                    <input type="text" value="<?= $task[0]['result'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Is late</label>
                    <input type="text" value="<?= $task[0]['is_late'] ?>" disabled>
                </div>
                <div class="form-group flex-start">
                    <label for="">File attachment</label>
                    <a class="" target="_blank" 
                    href="../download.php?path=<?=$task[0]['file']?>">
                    <?=$task[0]['file']?>
                </a>
                </div>
                <?php
                    if($task[0]['status'] == "Waiting"){
                        echo '<button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
                                data-bs-target="#modal-complete-task">
                                Complete
                            </button>
                            <button type="button" class="btn btn-danger mt-4" data-bs-toggle="modal"
                                data-bs-target="#modal-reject-task">
                                Reject
                            </button>';
                    }
                ?>
            </div>
            <div class="task-history">
                <h4>Task History</h4>
                <?php
                    foreach($task_histories as $task){
                        echo '<div class="task-item">';
                        echo '<strong class="title">'.$task['content'].' </strong>';
                        echo '<div class="time">'.$task['time'];
                        if($task['more_time'] != "0000-00-00"){
                            echo "  -> More deadline to ".$task['more_time'];
                        }
                        echo '</div>';
                        if($task['file'] != ""){
                            echo '
                            <div class="time">
                                <a class="" target="_blank" 
                                href="../download.php?path='.$task['file'].'">
                                    '.$task['file'].'
                                </a> 
                            </div>';
                        }
                        echo '<div class="type around '.$task['type'].'">'.$task['type'].'</div>';
                        echo '</div>';
                    }
                ?>
                
            </div>
        </section>

        <!-- modal reject task  -->
        <?php include '../partials/modals/reject_task.php'; ?>
        
        <!-- modal complete task -->
        <?php include '../partials/modals/complete_task.php'; ?>
    </div>
</body>

</html>