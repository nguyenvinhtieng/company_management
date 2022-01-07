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
    $tasks = get_my_task($my_username);
    $is_my_task = false;
    foreach($tasks as $t){
        if($t['id'] == $task_id){
            $is_my_task = true;
        }
    }
    if(!$is_my_task) {
        header('Location: ./index.php');
        exit();
    }

    if(isset($_POST['receive'])){
        if($task[0]['status'] != "New") $global_error = "Invalid action";
        else{
            $result_execute = receive_task($task_id);
            if($result_execute['success']){
                $_SESSION['message'] = "Task received!";
                header("Refresh:0");
                exit();
            }else{
                $global_error = $result_execute['message'];
            }
        }
    }

    if(isset($_POST['submit'])){
        $content = $_POST['content'];
        $file = $_FILES['file'];
        if($content == "") $global_error = "Content can not be empty";
        else{
            $result_uploadfile = upload_file($file);
            if($result_uploadfile['success']){
                $result_execute = submit_task($task_id, $content, $result_uploadfile['path']);
                if($result_execute['success']){
                    $_SESSION['message'] = $result_execute['message'];
                    header("Refresh:0");
                    exit();
                }else{
                    $global_error = $result_execute['message'];
                }
            }else{
                $global_error = $result_uploadfile['message'];
            }
        }
    }
    

?>
<?php include '../partials/head.php';?>

<body>
    <div class="layout-container">
    <?php 
            require_once('../partials/header_employee.php');
            echo_header_employee("task");
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
                    if($task[0]['status'] == "New"){
                        echo '<button type="button" class="btn btn-success mt-4" data-bs-toggle="modal"
                                data-bs-target="#modal-receive-task">
                                Receive
                            </button>';
                    }
                    if($task[0]['status'] == "In progress" || $task[0]['status'] == "Rejected"){
                        echo '<button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
                                data-bs-target="#modal-submit-task">
                                Submit
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

        <!-- modal submit task  -->
        <?php include '../partials/modals/submit_task.php';?>
        
        <!-- modal receive task -->
        <?php include '../partials/modals/receive_task.php';?>
        
    </div>
</body>

</html>