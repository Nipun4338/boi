<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | বই</title>
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
	.hello {
	    height: 51vh;
	}

	</style>

</head>

<body>
	<?php
	include('includes/nav.php');
	 ?>
	 <div class="hello">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">

    </div>
    <div class="col-md-4">
      <section class="container">
      	<section class="row">
      		<section class="col-md-12">
      			<form class="form-container" action="code.php" method="POST">
        				<div class="form-group">
        					<h2 style="text-align:center"><b>Login</b></h2>
      						<?php

      								if(isset($_SESSION['status']) && $_SESSION['status'] !='')
      								{
      										echo '<h6 class="bg-danger text-white"> '.$_SESSION['status'].' </h6>';
      										unset($_SESSION['status']);
      								}
      						?>
      			    <label for="exampleInputEmail1">Email address</label>
      			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
      			  </div>
      			  <div class="form-group">
      			    <label for="exampleInputPassword1">Password</label>
      			    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
      			  </div>
      			  <button type="submit" name="login" class="btn btn-primary btn-block submit">Submit</button>


      			</form>
            <div style="text-align:right">
              <a type="submit" href="subscribe.php" name="signup" >New?</a>
            </div>


      					</section>
      	</section>

      </section>
    </div>

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
