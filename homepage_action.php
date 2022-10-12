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
  if(isset($_POST['rolemanage']))
  {
    header("Location: rolemanagement_form.php");
  }
  if(isset($_POST['addEmployee']))
  {
    header("Location: manageEmployeeAccount.php");
  }
  if(isset($_POST['addUser']))
  {
    header("Location: manageUser.php");
  }
?>