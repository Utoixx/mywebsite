<?php  
  session_start(); 
  if(isset($_SESSION['use']))                  
  {
    header("Location:home.php"); 
  }
?>
<!DOCTYPE html>
<html>
<body>

<h2>Login form</h2>

<form action="/login_action.php" method="post">

    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required><br>
        
    <button type="submit" name="login">Login</button>
    <button onclick="document.location='signup_form.html'" type="submit">Create new account</button>
</form>

</body>
</html>
