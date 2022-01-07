<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $params = get_params();
    try{
        $department_id = (int) $params['id'];
        $department = get_department($department_id);
        $employees = get_employee_in_department($department_id);
        if(count($department) == 0){
            header('Location: ./department.php');
            exit();
        }
    }catch(Exception $err){
        header('Location: ./department.php');
        exit();
    }
    if(isset($_POST['edit'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $room = $_POST['room'];
        $manager = $_POST['manager'];
        if($name == "") 
            $global_error =  "Please enter a name";
        else if($description == "")
            $global_error = "Please enter a description";
        else if($room == "")
            $global_error = "Please enter a room";
        else{
            $result_execute = edit_department($department_id, $name, $description, $room, $manager);
            if($result_execute['success']){
                $_SESSION['message'] = "Department updated!";
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
            require_once('../partials/header_admin.php');
            echo_header_admin("department");
        ?>
        <!-- modal change password -->
        <?php include '../partials/modals/change_pass.php';?>
        <!-- // content page -->
        <section class="department">
            <div class="department-edit">
                <?php include '../partials/show_message.php';?>
                <h3>Edit Department</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" required value="<?= $department[0]['name'] ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" name="description" required value="<?= $department[0]['description'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="">Room</label>
                        <input type="text" name="room" value="<?= $department[0]['room'] ?>" >
                    </div>
                    <div class="form-group">
                        <label for="">Manager</label>
                        
                        <select id="" name="manager" >
                            <?php
                                if($department[0]['manager'] == ""){
                                    echo '<option value="">Select manager</option>';
                                }else{
                                    echo '<option value="'.$department[0]['manager'].'">'.$department[0]['manager'].'</option>';
                                }
                                foreach($employees as $employee){
                                    echo '<option value="'.$employee['username'].'">'.$employee['username'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary mt-2 w-f" type="submit" name="edit">Save</button>
                    </div>
                </form>
            </div>
        </section>

    </div>
</body>

</html>