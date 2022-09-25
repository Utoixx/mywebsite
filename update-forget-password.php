<?php
if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
{
    include "connection.php";
    $emailId = $_POST['email'];
    $token = $_POST['reset_link_token'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $query = mysqli_query($con,"SELECT * FROM `users` WHERE `reset_link_token`='".$token."' and `email`='".$emailId."'");
    $row = mysqli_num_rows($query);
    if($row){
        mysqli_query($con,"UPDATE users set  password='" . $password . "', reset_link_token='" . NULL . "' WHERE email='" . $emailId . "'");
        echo "<script>
                alert('Reset password successful! Please re-login!');
                window.location.href='login_form.php';
            </script>";
}else{
    echo "<script>
    alert('Something was wrongl! Please try again');
    window.location.href='index.php';
    </script>";
}
}
?>