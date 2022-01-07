<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $department_id_global = $_SESSION['department_id'];
    $my_username = $_SESSION['username'];
    $employees = get_employee_in_department($department_id_global);
    $index_me = 0;
    for($i = 0; $i < count($employees); $i++){
        if($employees[$i]["username"]  == $my_username ){
            $index_me = $i;
        }
    }
    unset($employees[$index_me]);
    if(isset($_POST['create'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        $employee = $_POST['employee'];
        $file = $_FILES["file"];
        $count = 0;
        foreach($employees as $e){
            if($e['username'] == $employee){
                $count ++;
            }
        }
        if($count == 0) $global_error = "Invalid employee";
        else if($title == "") $global_error ="Please enter a title";
        else if($description == "") $global_error ="Please enter a description";
        else if($deadline == "") $global_error ="Please enter a deadline";
        else{
            $file_name_result = upload_file($file);
            if($file_name_result['success']){
                $file_name = $file_name_result['path'];
                $result_exe = insert_task($file_name,$title, $description, $deadline,$employee,$department_id_global);
                if($result_exe["success"]){
                    $global_message = $result_exe['message'];
                }else{
                    $global_error = $result_exe['message'];
                }
            }else{
                $global_error = $file_name_result['message'];
            }
        }
    }

    $tasks = get_task_of_department($department_id_global);

    if(isset($_POST['cancel'])){
        $task_id = $_POST['task_id'];
        // check 
        $found_task = false;
        for($i = 0; $i < count($tasks); $i++){
            if($tasks[$i]['id'] == $task_id){
                $found_task = true;
                if($task[$i]['status'] != "New") $found_task = false;
            }
        }
        if($task_id == "") $global_error = "Task not found";
        else if(!$found_task) $global_error = "Invalid action";
        else{
            $result_execute = change_status_task($task_id, "Canceled");
            if($result_execute['success']){
                $global_message = $result_execute['message'];
                header("Refresh:0");
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
            echo_header_manager("task");
        ?>
        <!-- modal change password -->
        <?php include '../partials/modals/change_pass.php';?>
       
        <!-- // content page -->
        <section class="manage">
            <?php include '../partials/show_message.php';?>

            <div class="manage-heading">
                <h4> Tasks <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-task">Add
                        new task</button></h4>
            </div>

            <div class="manage-content">
                <div class="responsive-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Task id</th>
                                <th>Title</th>
                                <th>Employee Id</th>
                                <th>Status</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($tasks as $task) {
                                    echo '<tr>';
                                    echo '<td>'.$task['id'].'</td>';
                                    echo '<td>'.$task['title'].'</td>';
                                    echo '<td>'.$task['employee_id'].'</td>';
                                    echo '<td><div class="around '.$task['status'].'">'.$task['status'].'</div></td>';
                                    if($task['status'] == "New") {
                                        echo '<td class="table-operation">
                                                <a href="./taskdetail.php?id='.$task['id'].'">See</a>
                                                <a class="cancel href="" data-bs-toggle="modal"  data-id="'.$task['id'].'" data-bs-target="#modal-cancel-task">Cancel</a>
                                            </td>';
                                    }else{
                                        echo '<td class="table-operation">
                                                <a href="./taskdetail.php?id='.$task['id'].'">See</a>
                                            </td>';
                                    }
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <!-- modal cancel task  -->
        <div class="modal fade" id="modal-cancel-task" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this task?
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post">
                            <input type="hidden" id="task_id_canceled" name="task_id"/>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="cancel" class="btn btn-danger">Cancel task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal add task  -->
        <?php include '../partials/modals/add_task.php';?>
        

    </div>
</body>

</html>