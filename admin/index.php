<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';

    $global_error = "";
    $global_message = "";
    if(isset($_POST['create'])){
        $username = $_POST['username'];
        $name = $_POST['name'];
        $department_id = $_POST['department_id'];
        if($username == ""){
            $global_error = "Please enter a username";
            return;
        }
        if($name == ""){
            $global_error = "Please enter a name";
            return;
        }
        if($department_id == ""){
            $global_error = "Please choose department";
            return;
        }
        $result_execute = add_employee($username, $name, $department_id);
        if($result_execute['success']){
            $global_message = $result_execute['message'];
        }else{
            $global_error = $result_execute["message"];
        }
    }

    if(isset($_POST['reset'])){
        $username = $_POST['username'];
        if($username == ""){
            $global_error = "Has error";
            return;
        }
        $result_execute = reset_password($username);
        if($result_execute['success']){
            $global_message = $result_execute['message'];
        }else{
            $global_error = $result_execute['message'];
        }
    }
    $employees = get_employees();
?>
<?php include '../partials/head.php';?>
<body>
    <div class="layout-container">
    <?php 
        require_once('../partials/header_admin.php');
        echo_header_admin("employee");
    ?>
        <!-- modal change password -->
        <?php include '../partials/modals/change_pass.php';?>
        <!-- // content page -->
        <section class="manage">
            <?php include '../partials/show_message.php';?>

            <div class="manage-heading">
                <h4> Manage employees <button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-add-employee">Add new employee</button></h4>
            </div>

            <div class="manage-content">
                <div class="responsive-table">
                    <table>
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Full Name</th>
                                <th>Department name</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($employees as $employee){
                                    echo '<tr>';
                                    echo '<td>'.$employee['username'].'</td>';
                                    echo '<td>'.$employee['fullname'].'</td>';
                                    echo '<td>'.$employee['name'].'</td>';
                                    echo '<td class="table-operation">
                                    <button class="btn-eye btn-see-employee" data-bs-toggle="modal" data-bs-target="#modal-see-employee" ';
                                    echo 'data-username="'.$employee['username'].'"';
                                    echo 'data-name="'.$employee['fullname'].'"';
                                    echo 'data-department-id="'.$employee['id'].'"';
                                    echo 'data-department-name="'.$employee['name'].'"';
                                    echo 'data-position="'.$employee['role'].'"';
                                    echo 'data-avatar="'.$employee['avatar_link'].'"';
                                    echo '>';
                                    include '../partials/images/eye.php';    
                                    echo '</button>';
                                    echo '<button class="btn-reset" data-bs-toggle="modal" data-bs-target="#modal-reset-pass" ';
                                    echo 'data-username="'.$employee['username'].'"';
                                    echo '>';
                                    include '../partials/images/change.php';    
                                    echo '</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- modal add employee  -->
        <?php include '../partials/modals/add_employee.php';?>
        <!-- modal see employees -->
        <?php include '../partials/modals/see_employee.php';?>
        <!-- modal confirm reset pass  -->
        <?php include '../partials/modals/confirm_reset.php';?>
    </div>
</body>

</html>