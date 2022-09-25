<?php  
  session_start(); 
  if(isset($_SESSION['use']))                  
  {
    header("Location:homepage.php"); 
  }
?>
<!DOCTYPE html>
<html>
<body>
  <h2>Wellcome to my website!</h2>
  <button onclick="document.location='login_form.php'">Login</button>
  <button onclick="document.location='signup_form.php'">Sign up</button>
  <button onclick="document.location='forget_password.php'">Reset password</button>
</body>
</html>
