<!doctype html>
<html lang="en">
<body>
<?php
if($_GET['key'] && $_GET['token'])
{
    include "connection.php";
    $email = $_GET['key'];
    $token = $_GET['token'];
    $query = mysqli_query($con,
    "SELECT * FROM `users` WHERE `reset_link_token`='".$token."' and `email`='".$email."';"
    );
    if (mysqli_num_rows($query) > 0) {
        $row= mysqli_fetch_array($query);
{ ?>
        <form action="update-forget-password.php" method="post">
            <input type="hidden" name="email" value="<?php echo $email;?>">
            <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
            <label for="exampleInputEmail1">Password</label><br>
            <input type="password" name='password' class="form-control">            
            <label for="exampleInputEmail1">Confirm Password</label>
            <input type="password" name='cpassword' class="form-control">
            <input type="submit" name="new-password" class="btn btn-primary">
        </form>
<?php } 
    }
}
?>
</body>
</html>