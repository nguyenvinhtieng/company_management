<?php   
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    if(isset($_POST['create'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $room = $_POST['room'];
        if($name == ""){
            $global_error = "Please enter a name";
            return;
        }
        if($description == ""){
            $global_error = "Please enter a description";
            return;
        }
        if($room == ""){
            $global_error = "Please enter a room";
            return;
        }
        $result_execute = add_department($name, $description, $room);
        if($result_execute["success"]){
            $global_message = $result_execute["message"];
        }else{
            $global_error = $result_execute["message"];
        }
    }
    $departments = get_departments();
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
        <section class="manage">
            <?php include '../partials/show_message.php';?>
            <div class="manage-heading">
                <h4> Manage department <button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-add-department">Add</button></h4>
            </div>
            <div class="manage-content">
                <div class="responsive-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Room</th>
                                <th>Manager</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($departments as $department){
                                    echo '<tr>';
                                    echo '<td>'.$department['name'].'</td>';
                                    echo '<td>'.$department['description'].'</td>';
                                    echo '<td>'.$department['room'].'</td>';
                                    echo '<td>'.$department['manager'].'</td>';
                                    echo '<td class="table-operation">';
                                    echo '<a href="./editdepartment.php?id='.$department['id'].'">';
                                    include '../partials/images/edit.php';
                                    echo '</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- modal add department  -->
        <?php include '../partials/modals/add_department.php';?>
    </div>
</body>

</html>