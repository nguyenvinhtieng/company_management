<?php
    session_start();
    require_once('../main.php');
    include '../partials/check_permission.php';
    $global_error = "";
    $global_message = "";
    $department_id_global = $_SESSION['department_id'];
    $my_username = $_SESSION['username'];
    $tasks = get_my_task($my_username);
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

        <section class="manage">
            <div class="manage-heading">
                <h4> Tasks </h4>
            </div>

            <div class="manage-content">
                <div class="responsive-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Task id</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($tasks as $task){
                                    echo '<tr>';
                                    echo '<td>'.$task['id'].'</td>';
                                    echo '<td>'.$task['title'].'</td>';
                                    echo '<td>';
                                        echo '<div class="around '.$task['status'].'">';
                                        echo $task['status'];
                                        echo '</div>';
                                    echo '</td>';
                                    echo '<td><a href="./taskdetail.php?id='.$task['id'].'">See</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
</body>

</html>