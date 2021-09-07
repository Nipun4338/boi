<?php session_start();
$error = ''; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Subscribe | বই</title>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale = 1.0">

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
<body style="background:#fff">
  <?php
	include('includes/nav.php');
	 ?>

   <?php

	 include('database/dbconfig.php');
   date_default_timezone_set("Asia/Dhaka");
   $datetime = '';
       if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash']))
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
           $error = 'Your Email has successfully verified, now you can login.';
   			 }
          else{
           // No match -> invalid url or account has already been activated.

           $error = 'Something went wrong, try again....';

       }
       }
       else{
       // Invalid approach
       $error = 'Something went wrong, try again....';
   }
    ?>
		<div class="row justify-content-md-center">
            <div class="col col-md-4 mt-5">
            	<div class="alert alert-danger">
            		<h2><?php echo $error; ?></h2>
            	</div>
            </div>
        </div>

</body>


<div class="progress-container fixed-bottom">
  <div class="progress-bar" id="myBar">
    </div>
</div>
