<?php      
    include('connection.php');
    session_start(); 
    if(isset($_SESSION['use']))                  
    {
      header("Location:homepage.php"); 
    }
    $username = $_POST['uname'];  
    $password = $_POST['psw'];
    
    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password); 

    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  ;    

    if(isset($_POST['login'])) 
    { 
          if(checkuser())  // username is  set to "Ank"  and Password   
          {                                    
      
            $_SESSION['use']=$username;
            echo '<script type="text/javascript"> window.open("homepage.php","_self");</script>';
          }
          else
          {
            echo "invalid UserName or Password";        
          }
    }
    function checkuser()
    {
        global $con, $username, $password;
        $sql = "select paswd from user where id = '$username'";  
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);
              
        if($count == 1){
            while ($row = mysqli_fetch_row($result)) {
                if(password_verify($password, $row[0])){
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