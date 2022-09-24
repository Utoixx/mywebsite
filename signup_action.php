<?php      
    include('connection.php');  
    $username = $_POST['uname'];  
    $password = $_POST['psw'];
    $email  = $_POST['email'];
    $tel    = $_POST['tel'];
    $addr   = $_POST['addr'];
    
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password); 

        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  ;

      
        $sql = "select * from user where id = '$username'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
             echo "<h1><center> Username is existing! </center></h1>";  
        }  
        else{  
            $hash_default_salt = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (id, paswd, email, tel, addr)VALUES ('$username', '$hash_default_salt', '$email', '$tel', '$addr')";  
            $result = mysqli_query($con, $sql);  
            if($result){
                echo "<h1><center> Create successful! </center></h1>";
            }else{
                echo "<h1><center> Add account failed! </center></h1>";
            }
        }     
?>