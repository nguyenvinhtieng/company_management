<?php

define('DB_HOST', "127.0.0.1");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "web_programing");

function connect_database(){
    $conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if($conn) mysqli_query($conn,"SET NAME 'utf8'");
    else { 
        echo "Connecting failure"; 
        die();
    }
    return $conn;
}

function get_hour_now(){
    return (string) date("h:i");
}
function query_database($sql) {
    $conn = connect_database();
    $resultset = mysqli_query($conn,$sql);
    $data = [];
    while ($row = mysqli_fetch_array($resultset,1)) {
        $data[] = $row;
    }
    $conn -> close();
    return $data;
}
function login($username, $password){
    $sql = "select * from account where username = ? ";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('s',$username);
    if(!$stm -> execute()) 
        return array('success' => false, 'message' => 'Server error!');
    $result = $stm -> get_result();
    $conn -> close();
    if($result -> num_rows ==0) 
        return array('success' => false, 'message' => 'Not valid account');
    $data = $result -> fetch_assoc();
    $hashed_password = $data['password'];
    if(!password_verify($password,$hashed_password)) 
        return array('success' => false,'message' => 'Not valid account');
    else 
        return array('success' => true, 'message' => '','data' => $data);
}
function change_pass($username, $current_pass, $new_pass){
    $sql = "select * from account where username = ? ";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('s',$username);
    if(!$stm -> execute()) 
        return array('success' => false, 'message' => 'Server error!');
    $result = $stm -> get_result();
    if($result -> num_rows ==0) 
        return array('success' => false, 'message' => 'Not valid account');
    $data = $result -> fetch_assoc();
    $pass_hash = $data['password'];
    if(!password_verify($current_pass,$pass_hash)) 
        return array('success' => false,'message' => 'Current password not correct');
    
    // update password
    $password_hash = password_hash($new_pass, PASSWORD_BCRYPT);
    $sql = "update account set password = ? where username = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('ss',$password_hash,$username);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Password updated!');
}
function change_pass_f($username, $new_pass){
    $sql = "select * from account where username = ? ";
    $conn = connect_database();
    $password_hash = password_hash($new_pass, PASSWORD_BCRYPT);
    $sql = "update account set password = ? where username = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('ss',$password_hash,$username);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Password updated!');
}
function add_department ($name, $description, $room){
    $sql = "insert into department (name,description,room) VALUES(?,?,?)";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('sss', $name,$description,$room);
    if(!$stm -> execute())
        return array('success' => false, 'message' => 'Server error');
    $conn -> close();
    return array('success' => true, 'message' => 'Create department successfully');
}

function get_departments(){
    $sql = "select * from department";
    return query_database($sql);
}
function add_employee($username, $name, $department_id, $role = "employee", $avatar = "avatar.png"){
    $password_hash = password_hash($username, PASSWORD_BCRYPT);
    $sql = 'insert into account(username,password,role) values(?,?,?)';
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('sss', $username,$password_hash,$role);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Username was already taken');
    }
    $sql = 'insert into employee(username,fullname,department_id, avatar_link) values(?,?,?,?)';
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('ssss', $username,$name,$department_id, $avatar);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error!');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Add employee successfully');
}
function get_employees(){
    $sql = "select * from employee left join account on employee.username = account.username left join department on employee.department_id = department.id";
    return query_database($sql);
}

function reset_password($username){
    $password_hash = password_hash($username,PASSWORD_BCRYPT);
    $conn = connect_database();
    $sql = "update account set password = ? where username = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('ss',$password_hash,$username);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Password resest!');
}

function get_params(){
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
        $url = "https";
    else $url = "http";
    $url .= "://";
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    return $params;
}
function get_department($department_id){
    $sql = 'select * from department where id = "'.$department_id.'"';
    return query_database($sql);
}
function get_employee_in_department($department_id){
    $sql = 'select * from employee where department_id = "'.$department_id.'"';
    return query_database($sql);
}

function edit_department($department_id, $name, $description, $room, $manager){
    $sql = 'select * from department where id = '.$department_id;
    $department = query_database($sql)[0];
    $conn = connect_database();
    if($department['manager'] !== ""){
        $sql = "update account set role = 'employee' where username = ?";
        $stm = $conn -> prepare($sql);
        $stm -> bind_param('s', $department['manager']);
        if(!$stm -> execute())
            return array('succcess' => false,'message' => 'Server error!');
    }
    $sql = "update department set name = ? , description = ? , room = ? , manager = ? where id = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('ssssi', $name, $description, $room, $manager, $department_id);
    if(!$stm -> execute())
        return array('succcess' => false,'message' => 'Server error!');
    
    if($manager != ""){
        $sql = "update account set role = 'manager' where username = ?";
        $stm = $conn -> prepare($sql);
        $stm -> bind_param('s', $manager);
        if(!$stm -> execute())
            return array('succcess' => false,'message' => 'Server error!');
    }
    $conn -> close();

    return array('success' => true, 'message' => 'Department updated!');
}

function get_data_employee($username){
    $sql = 'select * from employee where username = "'.$username.'"';
    return query_database($sql)[0];
}

function upload_file($file){
    $target_file   = "./uploads/" . basename($file["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $maxfilesize   = 8000000000;
    $block_types    = array('exe', 'sh', 'pif', 'application', 'gadget', 'msi', 'msp', 'com','scr', 'hta','cpl','msc','jar','cmd','vb','vbs','vbe', 'js', 'jse', 'ws','wsf','wsc');
    if ($file['error'] != 0) return array('success' => true,'message' => '', 'path' => "");
    else if ($file['size'] > $maxfilesize) 
        return array('success' => false,'message' => 'File too large', 'path' => "");
    else if(in_array($imageFileType,$block_types )) 
        return array('success' => false,'message' => 'File type is not allowed', 'path' => "");
    else{
        $file_name = uniqid() . uniqid() .'.'.$imageFileType;
        move_uploaded_file($file['tmp_name'],'../uploads/'.$file_name);
        echo $file_name;
        return array('success' => true,'message' => 'File uploaded', 'path' => $file_name);
    }
}
function insert_task($file_name,$title, $description, $deadline,$employee, $department_id){
    $sql = 'insert into task(title,description,deadline,file,status,employee_id, department_id) values(?,?,?,?,?,?,?)';
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $status = "New";
    $stm -> bind_param('sssssss', $title,$description,$deadline,$file_name,$status,$employee, $department_id);
    if(!$stm -> execute())
        return array('success' => false, 'message' => 'Server error!');
    $conn -> close();
    return array('success' => true, 'message' => 'Task was add');
}
function get_task_of_department($department_id){
    $sql = 'select * from task where department_id = "'.$department_id.'" order by id desc';
    return query_database($sql);
}
function change_status_task($task_id, $status){
    $conn = connect_database();
    $sql = "update task set status = ? where id = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('si',$status,$task_id);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Task cancelled');
}
function get_task($task_id){
    $sql = 'select * from task, employee, department where task.id = '.$task_id.' and task.employee_id = employee.username and department.id = task.department_id';
    return query_database($sql);
}
function get_task_histories($task_id){
    $sql = 'select * from task_history where task = "'.$task_id.'" order by id desc';
    return query_database($sql);
}
function reject_task($file_name,$content, $deadline,$task_id){
    $sql = "insert into task_history (task,content,type, file, time, more_time, time_hour) VALUES(?,?,?,?,?,?,?)";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $type = "Rejected";
    $date_to_day = date("Y/m/d");
    $get_hours = get_hour_now();
    $stm -> bind_param('sssssss', $task_id,$content,$type,$file_name, $date_to_day, $deadline,$get_hours);
    if(!$stm -> execute())
        return array('success' => false, 'message' => 'Server error');
    $result_execute = change_status_task($task_id, $type);
    if(!$result_execute['success']) 
        return array('success' => false, 'message' => 'Server error');
    // more deadline
    if($deadline != ""){
        $sql = "update task set deadline = ? where id = ?";
        $stm = $conn -> prepare($sql);
        $stm -> bind_param('si',$deadline,$task_id);
        if(!$stm -> execute())
            return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Task was rejected');
}
function check_task_is_on_time($task_id){
    $sql = 'select * from task_history where task = "'.$task_id.'" order by id desc';
    return query_database($sql);
}
function date_diff_mycustom($date1, $date2)
{
    $date1_times = strtotime($date1);
    $date2_times = strtotime($date2);
    $result = $date2_times - $date1_times;
    return round($result / 86400);
}
function complete_task($task_id, $status, $ontime, $result){
    $conn = connect_database();
    $sql = "update task set status = ?, is_late = ? , result = ? where id = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('sssi',$status,$ontime, $result, $task_id);
    if(!$stm -> execute())
        return array('success' => false, 'message' => 'Server error');
    // add to history
    $sql = "insert into task_history (task,content,type, time, time_hour) VALUES(?,?,?,?,?)";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $type = "Completed";
    $content = "Task was completed!";
    $date_to_day = date("Y/m/d");
    $get_hours = get_hour_now();
    $stm -> bind_param('sssss', $task_id,$content,$type, $date_to_day, $get_hours);
    if(!$stm -> execute())
        return array('success' => false, 'message' => 'Server error');
    $conn -> close();
    return array('success' => true, 'message' => 'Task completed!');
}
function count_number_day_left($username, $role){
    $to_year = date("Y");
    $sql = "select * from application WHERE employee_id = '".$username."' and YEAR(date) = ".$to_year."";
    $applications = query_database($sql);
    $count_day = 0;
    foreach ($applications as $a){
        if($a['status'] == "approved")
            $count_day += $a['number']; 
    }
    if($role == "manager"){
        $day_left = 15 - $count_day;
    }else if($role == "employee"){
        $day_left = 12 - $count_day;
    }
    return $day_left;
}
function count_number_day_need_wait($username){
    $sql = "select * from application WHERE employee_id = '".$username."'";
    $applications = query_database($sql);
    $last_request = end($applications);
    $today = date("Y/m/d");
    if(count($applications) == 0) return 0;
    $number_day = date_diff_mycustom($last_request['date'], $today);
    if($number_day > 7) return 0;
    if($number_day < 7) return 7 - $number_day;
}
function add_application($username, $number, $type, $reason, $file_name, $department_id){
    $sql = "insert into application (employee_id,date,number,status,type, reason,file, department_id) VALUES(?,?,?,?,?,?,?,?)";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $today = date("Y/m/d");
    $status = "waiting";
    $stm -> bind_param('ssssssss', $username,$today, $number, $status,$type,$reason, $file_name,$department_id);
    if(!$stm -> execute())
        return array('success' => false, 'message' => 'Server error');
    $conn -> close();
    return array('success' => true, 'message' => 'Application was added!');
}
function get_my_application($username){
    $sql = 'select * from application where employee_id = "'.$username.'" order by id desc';
    return query_database($sql);
}
function get_my_information($username){
    $sql = 'select * from employee, department where username = "'.$username.'" and employee.department_id = department.id';
    return query_database($sql);
}
function upload_image($file){
    $target_file   = "./images/" . basename($file["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $maxfilesize   = 8000000000;
    $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
    if ($file['error'] != 0) return array('success' => true,'message' => '', 'path' => "");
    else if ($file['size'] > $maxfilesize) 
        return array('success' => false,'message' => 'File too large', 'path' => "");
    else if(!in_array($imageFileType,$allowtypes )) 
        return array('success' => false,'message' => 'File type is not allowed', 'path' => "");
    else{
        $file_name = uniqid() . uniqid() .'.'.$imageFileType;
        move_uploaded_file($file['tmp_name'],'../images/'.$file_name);
        return array('success' => true,'message' => 'File uploaded', 'path' => $file_name);
    }
}
function upload_avatar($username, $avatar){
    $conn = connect_database();
    $sql = "update employee set avatar_link = ? where username = ?";
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('ss',$avatar,$username);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Avatar updated!');
}
function get_my_task($username){
    $sql = 'select * from task where employee_id = "'.$username.'" and (NOT status = "Canceled") order by id desc ';
    return query_database($sql);
}
function receive_task($task_id){
    $result = change_status_task($task_id, "In progress");
    if($result['success']){
        $sql = "insert into task_history (task,content,type, time, time_hour) VALUES(?,?,?,?,?)";
        $conn = connect_database();
        $stm = $conn -> prepare($sql);
        $type = "Receive";
        $content = "User Receive task";
        $date_to_day = date("Y/m/d");
        $get_hours = get_hour_now();
        $stm -> bind_param('sssss', $task_id,$content,$type, $date_to_day, $get_hours);
        if(!$stm -> execute())
            return array('success' => false, 'message' => 'Server error');
        return array('success' => true, 'message' => 'Task received!');
    }else{
        return array('success' => false, 'message' => 'Server error!');
    }
}
function submit_task($task_id, $content, $file){
    $result = change_status_task($task_id, "Waiting");
    if($result['success']){
        $sql = "insert into task_history (task,content,type, file, time,time_hour) VALUES(?,?,?,?,?,?)";
        $conn = connect_database();
        $stm = $conn -> prepare($sql);
        $type = "Submit";
        $date_to_day = date("Y/m/d");
        $get_hours = get_hour_now();
        $stm -> bind_param('ssssss', $task_id,$content,$type,$file, $date_to_day, $get_hours);
        if(!$stm -> execute())
            return array('success' => false, 'message' => 'Server error');
        $conn -> close();
        return array('success' => true, 'message' => 'Task was submitted');
    }else{
        return array('success' => false, 'message' => 'Server error!');
    }
}
function get_application_of_department($department_id){
    $sql = 'select * from application, employee where application.department_id = "'.$department_id.'" and type="employee" and application.employee_id = employee.username';
    return query_database($sql);
}
function get_application_admin(){
    $sql = 'select * from application, employee where type="manager" and application.employee_id = employee.username';
    return query_database($sql);
}
function change_status_application($id, $status){
    $sql = "update application set status = ? where id = ?";
    $conn = connect_database();
    $stm = $conn -> prepare($sql);
    $stm -> bind_param('si',$status,$id);
    if(!$stm -> execute()){
        return array('success' => false, 'message' => 'Server error');
    }
    $conn -> close();
    return array('success' => true, 'message' => 'Application was processed successfully');
}
?>