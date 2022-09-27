<?php   
    session_start();
    include('connection.php');  
    $username = $_SESSION['use'];
    $currentpasswd = $_POST['currentpw'];
    $password = $_POST['psw'];
    
    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password); 

    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);
    
    if(checkuser()){
        $hash_default_salt = password_hash($password,PASSWORD_DEFAULT);
        $sql = "update users set password = '$hash_default_salt' where id = '$username'";  
        $result = mysqli_query($con, $sql);
        if($result){
            session_destroy();
            echo "<script>
                    alert('Change password successful! Please re-login!');
                    window.location.href='login_form.php';
                </script>";
        }
        else{
            $message = "Error change password process!";
            echo "<script>
                alert('Error change password process!');
                window.location.href='changepasswd_form.php';
            </script>";
        }
    }else{
        $message = "Current password incorrect!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    function checkuser()
    {
        global $con, $username, $currentpasswd;
        $sql = "select password from users where id = '$username'";  
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);
              
        if($count == 1){
            while ($row = mysqli_fetch_row($result)) {
                if(password_verify($currentpasswd, $row[0])){
                    return true;
                }  
                else
                    return false;
                }
            }  
        else{  
            return false;
        } 
    }     
?>