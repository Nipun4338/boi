<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Subscribe | বই</title>
	<meta charset="UTF-8">

	<meta name="viewport" content="width-device-width, initial scale = 1.0">

	<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" href="style.css">
  <link rel="icon" href="Iconsmind-Outline-Books-2.ico">


  <style media="screen">
  .header {
    position: fixed;
    top: 0;
    z-index: 1;
    width: 100%;
    background-color: #f1f1f1;
  }
  .header h2 {
    text-align: center;
  }

  .progress-container {
    width: 100%;
    height: 4px;
    background: #ccc;
  }

  .progress-bar {
    height: 4px;
    background: #4caf50;
    width: 0%;
  }

  .content {
    padding: 100px 0;
    margin: 50px auto 0 auto;
    width: 80%;
  }

  </style>


</head>
<body>
  <?php
	include('includes/nav.php');
	 ?>

   <?php

   $host="localhost";
   $user="root";
   $password="";
   $db="boi";
   $link=mysqli_connect($host,$user,$password,$db);
   date_default_timezone_set("Asia/Dhaka");
   $datetime = '';
       if(($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']))
        {
          $email = $_GET['email']; // Set email variable
          $hash = $_GET['hash']; // Set hash variable
          $sqlCheck="select email, hash, status FROM user WHERE email='".$email."' AND hash='".$hash."' AND status='2'";
   			 $result=mysqli_query($link,$sqlCheck);
   			 $noOfRows=mysqli_num_rows($result);
   			 if($noOfRows)
   			 {
            // We have a match, activate the account
           $sql="UPDATE user SET status='1' WHERE email='".$email."' AND hash='".$hash."' AND status='2'";
           $result=mysqli_query($link,$sql);
           echo '<div class="statusmsg">Your account has been activated, you can now login!</div>';
   			 }
          else{
           // No match -> invalid url or account has already been activated.

           echo '<p style="text-align:center;font-weight:bold">The url is either invalid or you already have activated your account.</p>';

       }
       }
       else{
       // Invalid approach
       echo '<div class="statusmsg" style="color:#fff">Invalid approach, please use the link that has been send to your email.</div>';
   }
    ?>

</body>


<div class="progress-container fixed-bottom">
  <div class="progress-bar" id="myBar">
    </div>
</div>
