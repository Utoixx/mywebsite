<?php  
  session_start(); 
  if(isset($_POST['logout']))                  
  {
    session_destroy();
    header("Location: index.php");
  }
  if(isset($_POST['changepswd']))
  {
    header("Location: changepasswd_form.php");
  }
?>