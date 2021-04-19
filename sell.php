<?php
include("security.php");
$host="us-cdbr-east-03.cleardb.com";
$user="ba1268b5ca99c6";
$password="557bfa4e";
$db="heroku_923aa6dacc1b73c";


$link=mysqli_connect($host,$user,$password,$db);
$sql="SELECT distinct author FROM author order by author";
$result=mysqli_query($link,$sql) or die(mysqli_error($link));
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){

      /*echo "<pre>";
      print_r($row);*/
      array_push($data,$row);
      //echo "</pre>";

  }
}
?>

<!DOCTYPE html>
<html>
<head>
		<title>Sell | বই</title>
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



    </style>
</head>

<body style="background:#fff">
  <?php
  include('includes/nav.php');
   ?>

<h1 style="text-align:center;border: 2px solid #8989;margin:10px">Select Your Book</h1>
<div class="darker" style="text-align:center;border: 2px solid #8989;margin:10px">
  <form action="script.php" enctype="multipart/form-data" method="POST">
  <div class="form-group" style="margin:3% 10% 2% 10%">
      <h4>Select Author</h4>
      <select name="authorselect" class="form-select" aria-label="Default select example">
        <?php foreach($data as $row){

        ?>
        <option value="<?php echo $row['author']; ?>"><?php echo $row['author'] ?></option>
      <?php } ?>
      </select>
  </div>
  <div class="form-group" style="margin:3% 10% 2% 10%">

      <h4>Book Name</h4>
      <input type="text" class="form-control" name="book" value="" placeholder="Enter Book Name" required>
  </div>
  <div class="form-group" style="margin:3% 10% 2% 10%">

      <h4>Category</h4>
      <input type="text" class="form-control" name="category" value="" placeholder="Enter Category" required>
  </div>
  <div class="form-group" style="margin:3% 10% 2% 10%">

      <h4>Price</h4>
      <input type="text" class="form-control" name="price" value="" placeholder="Enter Price" required>
  </div>
  <div class="form-group" style="margin:3% 10% 2% 10%">

      <h4>Details</h4>
      <input type="text" class="form-control" name="details" value="" placeholder="Details" required>
  </div>
  <div class="form-group" style="margin:3% 10% 2% 10%">

      <h4>Location</h4>
      <input type="text" class="form-control" name="location" value="" placeholder="Enter Location" required>
  </div>
  <div class="form-group" style="margin:3% 10% 2% 10%">
    <h4>Upload Book Image/s</h4>
    <input type="file" name="file_upload[]" class="form-control"required multiple/>
    *Your first choosen image will be the cover image in the advertise.
  </div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="submit" name="registerbtnbook" class="btn btn-primary">Save</button>
</div>
</form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	 </body>

<div class="progress-container fixed-bottom">
 <div class="progress-bar" id="myBar">
   </div>
</div>
<?php
include('includes/footer.php');
?>
