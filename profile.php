<?php
include("security.php");
?>
<?php
$host="localhost";
$user="root";
$password="";
$db="boi";

$link=mysqli_connect($host,$user,$password,$db);
$email=$_SESSION['username'];

$sql="SELECT * FROM user where email='$email'";
$result=mysqli_query($link,$sql);
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

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile | বই</title>
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

  </style>



</head>
<body>
  <?php
	include('includes/nav.php');
	 ?>

<section>
	<div class="row header">
		<h2><b>Manage My Account</b></h2>
	</div>
</section>

<section>
	<div class="container manage-account">
	<div class="row account">
		<?php
			foreach($data as $row){
		?>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <img style="float:left;border-radius: 50%;" src="<?php echo $row["image"] ?>" height="200px" width="200px">
    </div>
		<div class="col-lg-6 col-md-6 col-sm-6" style="border:1px solid #ddd; color:#666">
				<h4 style="border-bottom:1px solid #ddd;padding:10px">Personal Details</h4>
				<h4>Name:  <?php echo $row['name']?></h4>
				<h4>Email: <?php echo $row['email']?></h4>
				<h4>Cell: <?php echo $row['phone']?></h4>
			</div>

			<?php
		}
			?>
			</div>
		</div>
	</div>





	</section>


	<section>
		<div class="container order-table-div">
			<table class="order-table">
				<tr>
					<th>Order #</th>
					<th>Order Date</th>
					<th>Product</th>
					<th>Price</th>
					<th>State</th>
				</tr>
			</table>

		</div>
	</section>

</body>

<div class="progress-container fixed-bottom">
  <div class="progress-bar" id="myBar">
    </div>
</div>
<?php
include('includes/footer.php');
 ?>
