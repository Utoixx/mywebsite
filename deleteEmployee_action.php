<?php
    include('Role.php');
    include('connection.php');

    $cmdDelete = "delete";
    $cmdModify = "modify";

    $q = $_REQUEST["q"];
    $str = explode("?", $q);
    if(strcmp($str[0], $cmdDelete) === 0)
    {
        $sql = "delete from user_role where id = '$str[1]'";
        $result = mysqli_query($con, $sql);
        $sql = "delete from users where id = '$str[1]'";
        $result = mysqli_query($con, $sql);  
        echo "Success!";
    }
?>