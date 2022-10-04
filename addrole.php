<?php
    include('connection.php');  
    $role_name = $_POST['role_name'];  
    $add_employee = $_POST['add_employee'];
    $edit_employee = $_POST['edit_employee'];
    $delete_employee = $_POST['delete_employee'];
    $add_user = $_POST['add_user'];
    $edit_user = $_POST['edit_user'];
    $delete_user = $_POST['delete_user'];
    $add_role = $_POST['add_role'];
    $edit_role = $_POST['edit_role'];
    $delete_role = $_POST['delete_role'];
    $approve_surve = $_POST['approve_surve'];
    $enable_user_account = $_POST['enable_user_account'];
        
    //to prevent from mysqli injection  
    $role_name = stripcslashes($role_name);   
    
    $role_name = mysqli_real_escape_string($con, $role_name); 

    $sql = "insert into roles(role_name) value('$role_name')";  
    $result = mysqli_query($con, $sql);  
    
    $sql = "select * from roles where role_name = '$role_name'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);

    $role_id = $row[0];

    if($add_employee != NULL){
        $sql = "select * from permissions where perm_desc = 'addEmployee'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($edit_employee != NULL){
        $sql = "select * from permissions where perm_desc = 'editEmployee'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($delete_employee != NULL){
        $sql = "select * from permissions where perm_desc = 'deleteEmployee'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($add_user != NULL){
        $sql = "select * from permissions where perm_desc = 'addUser'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($edit_user != NULL){
        $sql = "select * from permissions where perm_desc = 'editUser'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($delete_user != NULL){
        $sql = "select * from permissions where perm_desc = 'deleteUser'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    }
    if($add_role != NULL){
        $sql = "select * from permissions where perm_desc = 'addRole'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($edit_role != NULL){
        $sql = "select * from permissions where perm_desc = 'editRole'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($delete_role != NULL){
        $sql = "select * from permissions where perm_desc = 'deleteRole'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($enable_user_account != NULL){
        $sql = "select * from permissions where perm_desc = 'enableUserAccount'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    } 
    if($approve_surve != NULL){
        $sql = "select * from permissions where perm_desc = 'approveSurvey'"; 
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        $perm_id = $row[0];
        $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)"; 
        $result = mysqli_query($con, $sql);
    }
    echo "<script>
    window.location.href='rolemanagement_form.php';
    </script>"; 
?>