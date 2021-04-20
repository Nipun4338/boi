<?php session_start(); ?>
<?php
include('database/dbconfig.php');
date_default_timezone_set("Asia/Dhaka");
$datetime = '';
    if(isset($_REQUEST['submit']))
     {
			 $datetime=date('Y-m-d H:i:s');
			 $user_email=$_POST["email"];
			 $user_name=$_POST["name"];
			 $user_phone=$_POST["phone"];
			 $user_address=$_POST["address"];
			 $user_password=md5($_POST["password"]);
			 $sqlCheck='select * from user where email="'.$user_email.'"';
			 $result=mysqli_query($link,$sqlCheck);
			 $noOfRows=mysqli_num_rows($result);
			 if($noOfRows)
			 {
				 while($row=mysqli_fetch_assoc($result)){
			     if($row['status']==2)
			     {
						echo '<script language="javascript">';
	 					echo 'alert("Please Confirm your Email!!")';
	 					echo '</script>';
			     }
					 else {
						 echo '<script language="javascript">';
 	 					echo 'alert("Already Registered!!")';
 	 					echo '</script>';
					 }
			   }
			 }
			 else {
         $target_dir="";
         if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
         {
           $target_dir="images/users/default-image.jpg";
         }
         else{
           $random=rand();
           $userFileName='user_pic_'.$user_phone.$random;
  	       $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
  	       $target_dir="images/users/".$userFileName.".".$imageType;
  	       $target_file=$target_dir;
  	       $temp_file=$_FILES['file_upload']['tmp_name'];
  	       move_uploaded_file($temp_file, $target_file);
         }
         $hash1 = md5( rand(0,1000) );
				 $sqlInsert='insert into user(name,email,phone,address,password,image,status,created_date,updated_date,hash)
				 values("'.$user_name.'","'.$user_email.'","'.$user_phone.'","'.$user_address.'","'.$user_password.'","'.$target_dir.'",2,"'.$datetime.'","'.$datetime.'","'.$hash1.'")';
				 $resultInsert=mysqli_query($link, $sqlInsert);

          $mailContent= '

          Thanks for signing up!
          Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

          ------------------------
          Name: '.$user_name.'
          ------------------------

          Please click this link to activate your account:
          http://localhost/boi/verify.php?email='.$user_email.'&hash='.$hash1.'

          '; // Our message above including the link


          // Authorisation details.
        	$username = "boi.yourbook@gmail.com";
        	$hash = "f32876c0f3261cfee4230f1abc976d519900c329fcc1c1b90338bc4ba0a716b1";

        	// Config variables. Consult http://api.txtlocal.com/docs for more info.
        	$test = "0";

        	// Data for text message. This is the text message data.
        	$sender = "Boi"; // This is who the message appears to be from.
        	$numbers = $user_phone; // A single number or a comma-seperated list of numbers
        	$message = $mailContent;
        	// 612 chars or less
        	// A single number or a comma-seperated list of numbers
        	$message = urlencode($message);
        	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        	$ch = curl_init('http://api.txtlocal.com/send/?');
        	curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	$result1 = curl_exec($ch); // This is the result from the API
        	curl_close($ch);

				echo ("Successfully Registered! Please Confirm your email!");
        header('Location: login.php');

			 }
    }
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Subscribe | বই</title>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale = 1.0">

	<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-8">

       </div>
       <div class="col-md-4">
  <section class="container-fluid">
    	<section class="row justify-content-right">
    		<section class="col-md-12">
    			<form class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
              <h2 style="text-align:center"><b>Sign Up</b></h2>
              <label>Name</label>
              <input type="text" name="name" value="" placeholder="Enter your name" class="form-control" required />
            </div>
            <div class="form-group mb-3">
              <label>Email</label>
              <input type="email" name="email" value="" placeholder="Enter your email (must be unique)" class="form-control" required />
            </div>
            <div class="form-group mb-3">
              <label>Phone</label>
              <input type="Phone" name="phone" value="" placeholder="Enter your phone number" class="form-control" required />
            </div>
            <div class="form-group mb-3">
              <label>Address</label>
              <textarea type="message" name="address" placeholder="Type your address here" class="form-control" required></textarea>
            </div>
            <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" id="password"  name="password" value="" placeholder="Enter your password" class="form-control" required />
            </div>
            <div class="form-group mb-3">
              <label>Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Retype Password" class="form-control" required />
              <span id='message'></span>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script>
            $('#password, #confirm_password').on('keyup', function () {
              if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
              } else
                $('#message').html('Not Matching').css('color', 'red');
            });
            </script>
            <div class="form-group mb-3">
              <label>Upload Profile Picture</label>
              <input type="file" name="file_upload" class="form-control"/>
            </div>
    			  <div class="form-check">
    			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    			    <label class="form-check-label" for="exampleCheck1">By creating an account you agree <br>to our <a href="#" style="color:black">Terms & Policy</a></label>
    			  </div>

    			  <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary btn-block submit2">Submit</button>
						<a href="login.php" style="float: right">Not New?</a>

    			</form>
    					</section>
    	</section>
    </section>
    </div>
    </div>
    </div>


</body>

<div class="progress-container fixed-bottom">
  <div class="progress-bar" id="myBar">
    </div>
</div>
<?php
include('includes/footer.php');
 ?>
