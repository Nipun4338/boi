<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "boi.yourbook@gmail.com";
$mail->Password = "zffwybtbangyivph";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom("boi.yourbook@gmail.com", "Boi");
$mail->addAddress("nipun4337@gmail.com");
$mail->isHTML(false);
$mail->Subject = "Registration Verification of Boi";
$mail->Body = '

          <p>Thanks for signing up!</p>
          <p>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</p>


          <p>------------------------</p>
          <p>Name: </p>
          <p>------------------------</p>

          <p>Please click this link to activate your account:</p>
          <p><a href="http://boi-yourbook.herokuapp.com/">Click to Verify</a></p>

          '; // Our message above including the link

$mail->send();
?>
