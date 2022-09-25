<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    include "connection.php";
     
    $emailId = $_POST['email'];
 
    $result = mysqli_query($con,"SELECT * FROM users WHERE email='" . $emailId . "'");

    $row= mysqli_fetch_array($result);
 
  if($row)
  {
     
    $token = md5($emailId).rand(10,9999);
 
    $update = mysqli_query($con,"UPDATE users set  password='" . $password . "', reset_link_token='" . $token . "' WHERE email='" . $emailId . "'");

 
    $link = "<a href='"."https://".$_SERVER['SERVER_NAME']."/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";

    require_once('vendor/autoload.php');
    $mail = new PHPMailer();

 
 
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "quoctuan2000bkav@gmail.com";
    // GMAIL password
    $mail->Password = "zhfiqtatandofplp";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->From='quoctuan2000bkav@gmail.com';
    $mail->FromName='Admin';
    $mail->AddAddress($emailId, 'You');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }else{
    echo "Invalid Email Address. Go back";
  }
}
?>