<!doctype html>
<html lang="en">
<body>
  <button onclick="document.location='index.php'">Home</button>
    We will send a reset link to your email!
    <form action="forgetpasswd_action.php" method="post">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
      <input type="submit" name="password-reset-token">
    </form>
   </body>
</html>