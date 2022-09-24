<?php      
    $host = "localhost";  
    $user = "tuanduong";  
    $password = 'quoctuan2K@';  
    $db_name = "mywebsite";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }
?>