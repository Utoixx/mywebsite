<?php
    include('Role.php');
    include('connection.php');

    $q = $_REQUEST["q"];
    $str = explode("?", $q);

    $sql = "select * from roles where role_name = '$str[1]'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);

    $sql = "delete from user_role where id = '$str[0]' and role_id = $row[0]";
    $result = mysqli_query($con, $sql);

    echo "Success!";
?>
