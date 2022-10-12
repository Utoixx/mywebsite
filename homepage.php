<?php  
  session_start(); 
  if(!isset($_SESSION['use']))                  
  {
    $message = "Your session expired!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: index.php");
  }
  echo "<h4>Hello ".$_SESSION['use']."</h4>";
?>
<!DOCTYPE html>
<html>
<body>
  <h2>Wellcome to homepage!</h2>
  <form action="homepage_action.php" method="post">
    <button type="submit" name="changepswd">Change password</button>
    <button type="submit" name="logout">Log out</button>
<?php
    require_once "PrivilegedUser.php";
    require_once "Role.php";
    $userID = $_SESSION['use'];

    $u = PrivilegedUser::getByUserID($userID);
    if($u->hasPrivilege("addRole"))
    {?>
      <button type="submit" name="rolemanage">Role manage</button>
    <?php }
?>
<?php
    $userID = $_SESSION['use'];

    $u = PrivilegedUser::getByUserID($userID);
    if($u->hasPrivilege("addEmployee"))
    {?>
      <button type="submit" name="addEmployee">Employee management</button>
    <?php }
?>
<?php
    $userID = $_SESSION['use'];

    $u = PrivilegedUser::getByUserID($userID);
    if($u->hasPrivilege("addUser"))
    {?>
      <button type="submit" name="addUser">User management</button>
    <?php }
?>
  </form>
</body>
</html>
