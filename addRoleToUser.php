<?php
    include('Role.php');
    include('connection.php');

    $user_id = $_POST['user_name'];  
    $role_name = $_POST['role_name'];

    $sql = "select * from roles where role_name = '$role_name'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    if(!$row)
    {
        echo "<script>
        alert('Role name not exist!');
        window.location.href='rolemanagement_form.php';
        </script>"; 
    }  

    $sql = "insert into user_role(id, role_id) values('$user_id', $row[0])";
    $result = mysqli_query($con, $sql);  
    if(!$result)
    {
        echo "<script>
        alert('Account not exist!');
        window.location.href='rolemanagement_form.php';
        </script>"; 
    }else
    {
        echo "<script>
        alert('Success!');
        window.location.href='rolemanagement_form.php';
        </script>"; 
    }
?>