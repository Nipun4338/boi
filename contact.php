<?php session_start();
if (isset($_POST["submit"])) {
  $host="us-cdbr-east-03.cleardb.com";
  $user="ba1268b5ca99c6";
  $password="557bfa4e";
  $db="heroku_923aa6dacc1b73c";

  $connection = mysqli_connect($host,$user,$password,$db);
  if (!isset($_SESSION["username"]))
  {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $message=$_POST['message'];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $query="insert into contact(name,email,phone,message,date) values ('$name','$email','$phone','$message','$datetime')";
    $query_run=mysqli_query($connection, $query);
    if($query_run)
    {
      $_SESSION['success']="Message Sent";
      header('Location: contactus.php');
    }
    else {
      $_SESSION['success']="Sent Failed";
      header('Location: contactus.php');
    }
  }
  else {
    $email=$_SESSION['username'];

    $sql="SELECT * FROM user where email='$email'";
    $result=mysqli_query($connection,$sql);
    $data=array();
    $noOfRows=mysqli_num_rows($result);
    if($noOfRows){
      while($row=mysqli_fetch_assoc($result)){
        if($row['status']==1)
        {
          /*echo "<pre>";
          print_r($row);*/
          array_push($data,$row);
          //echo "</pre>";
        }
      }
    }
    foreach($data as $row){
      $name=$row['name'];
      $phone=$row['phone'];
    }
    $message=$_POST['message'];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $query="insert into contact(name,email,phone,message,date) values ('$name','$email','$phone','$message','$datetime')";
    $query_run=mysqli_query($connection, $query);
    if($query_run)
    {
      $_SESSION['success']="Message Sent";
      header('Location: contact.php');
    }
    else {
      $_SESSION['success']="Sent Failed";
      header('Location: contact.php');
    }
  }


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Us | বই</title>
	<meta charset="UTF-8">

	<meta name="viewport" content="width-device-width, initial scale = 1.0">

	<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="style1.css">
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
  /* width */

  </style>



</head>
<body>
  <?php
	include('includes/nav.php');
	 ?>
   <canvas id="bgCanvas"></canvas>
<!-- partial -->
  <script  src="script1.js"></script>
   <div class="container-fluid" style="margin-top:400px;">
     <div class="row">
       <div class="col-md-6" style="color: #000;background:#6C6D6D;">
           <h1>CONTACT US</h1>
           <h6>Email :- boi.yourbook@gmail.com</h6>
       </div>

       <div class="col-md-6" style="margin: 5px,5px,5px,5px;  background:#6C6D6D; padding:10px; font-weight:bold">
         <?php
         if(isset($_SESSION['success']) && $_SESSION['success']!='')
         {
           echo '<h2>'.$_SESSION['success'].'</h2>';
           unset($_SESSION['success']);
         }
         if(isset($_SESSION['status']) && $_SESSION['status']!='')
         {
           echo '<h2 class="bg-info">'.$_SESSION['status'].'</h2>';
           unset($_SESSION['status']);
         }
          ?>
         <form action="contact.php" method="POST" enctype="multipart/form-data">
           <?php if (!isset($_SESSION["username"])) {

           $message= '<div class="form-group mb-3" >
             <label>Name</label>
             <input type="text" name="name" value="" placeholder="Enter your name" class="form-control" required />
           </div>
           <div class="form-group mb-3">
             <label>Email</label>
             <input type="email" name="email" value="" placeholder="Enter your email" class="form-control" required />
           </div>
           <div class="form-group mb-3">
             <label>Phone</label>
             <input type="Phone" name="phone" value="" placeholder="Enter your phone number" class="form-control" required />
           </div>
           <div class="form-group mb-3">
          <label>Message</label>
          <textarea type="message" id="message" name="message" placeholder="Type your message here" class="form-control" required></textarea>
        </div>';
         }
         else {
           $message='<div class="form-group mb-3">
          <label>Message</label>
          <textarea type="message" id="message" name="message" placeholder="Type your message here" class="form-control" required></textarea>
        </div>';
         }

           echo ($message);?>


           <div class="form-group mb-3" >
             <input type="submit" name="submit" value="Submit" class="btn btn-success" />
           </div>
         </form>
         <script type="text/javascript">
         $(document).ready(function() {
           $('input[type="submit"]').attr('disabled', true);

           $('textarea').on('keyup',function() {
               var textarea_value = $("#message").val();

               if(textarea_value != '') {
                   $('input[type="submit"]').attr('disabled', false);
               } else {
                   $('input[type="submit"]').attr('disabled', true);
               }
           });
         });
         </script>

       </div>
     </div>
   </div>


</body>

<div class="progress-container fixed-bottom">
 <div class="progress-bar" id="myBar">
   </div>
</div>
