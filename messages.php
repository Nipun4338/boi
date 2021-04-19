<?php
include("security.php");
$host="us-cdbr-east-03.cleardb.com";
$user="ba1268b5ca99c6";
$password="557bfa4e";
$db="heroku_923aa6dacc1b73c";

$link=mysqli_connect($host,$user,$password,$db);
?>

<!DOCTYPE html>
<html>
<head>
		<title>Messages | বই</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width-device-width, initial scale = 1.0">
		<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Iconsmind-Outline-Books-2.ico">


<style type="text/css">
        /*Setting Basic Dimensions to give
        gallary view */

        .container{
            margin: 0 auto;
            width: 90%;
        }
        .main_view{
            width: 80%;
            height: 25rem;
        }
        .main_view img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .side_view{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .side_view img{
            width: 9rem;
            height: 7rem;
            object-fit: cover;
            cursor: pointer;
            margin:0.5rem;
        }
        ul.info{
          list-style: none;
          border-top: 1px dotted #AAA;
          margin: 60px 0 20px;
          font-size: 20px;
        }

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
        .header1 {
  background-color: #666;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}


.container1 {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container1::after {
  content: "";
  clear: both;
  display: table;
}

.container1 img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container1 img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.hello {
    margin: 0px 0 200px 0;
}

    </style>
</head>

<body style="background:#fff">
  <?php
  include('includes/nav.php');
   ?>
<div class="hello">
<div class="header1" style="text-align:center;">
<h1>Recent Contacts</h1>
</div>
<?php
$user = $_SESSION['user_id'];

$sql = "SELECT distinct concat(receiver_id,sender_id) as final from messages where (sender_id='$user' and receiver_id!='$user')  or (sender_id!='$user' and receiver_id='$user') order by datesent desc";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {

	 if($row["final"]!=$_SESSION["user_id"])
	 {
		 $receiver_id=$row["final"];
	 }


   $sql1 = "SELECT name,user_id from user where user_id='$receiver_id'";
   $result1 = mysqli_query($link, $sql1);
   if (mysqli_num_rows($result1) > 0) {
     while($row1 = mysqli_fetch_assoc($result1)) {

?>
<form class="form-container" action="chat.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="user_id1" value="<?php echo $row1["user_id"] ?>">
	<?php $_SESSION["receive"]=$row1["user_id"]; ?>
	<input type="hidden" name="user_name" value="<?php echo $row1["name"] ?>">
	<?php $_SESSION["receive_name"]=$row1["name"]; ?>
<button type="submit" class="container1" style="text-align: center;cursor: pointer;width:100%"><h3><?php echo $row1["name"] ?></h3></button>
</form>
<?php
}} }
}else {
echo "0 Results";
} ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</div>
	 </body>

<div class="progress-container fixed-bottom">
 <div class="progress-bar" id="myBar">
   </div>
</div>
<?php
include('includes/footer.php');
?>
