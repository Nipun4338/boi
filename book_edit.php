<?php
include("security.php");
?>
<?php
$host="localhost";
$user="root";
$password="";
$db="boi";

$link=mysqli_connect($host,$user,$password,$db);

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

   <div class="container-fluid" >

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
     <div class="card-header py-3">
       <h4 style="text-align:center" class="m-0 font-weight-bold text-primary">EDIT Book Details
       </h4>
     </div>

     <div class="card-body">
       <?php
       $connection = mysqli_connect("localhost","root","","boi");
       if(isset($_POST['edit_btn_book']))
       {
         $id=$_POST['edit_id_book'];
         $query = "SELECT * FROM books WHERE book_id='$id' ";
         $query_run = mysqli_query($connection, $query);
         foreach ($query_run as $row) {
           ?>
             <form action="script.php" method="POST" enctype="multipart/form-data">
               <input type="hidden" name="edit_id_book" value="<?php echo $id?>">
               <div class="form-group">
                   <label> Book Name :</label>
                   <label> <?php  echo $row['name']; ?> </label>
               </div>
               <div class="form-group">
                   <label> Author :</label>
                   <label> <?php  echo $row['author']; ?> </label>
               </div>
               <div class="form-group">
                   <label> Price </label>
                   <input type="number" name="edit_price" value="<?php  echo $row['price']; ?>" class="form-control" required >
               </div>
               <div class="form-group">
                   <label>Details</label>
                   <input type="text" name="edit_details" value="<?php  echo $row['present_condition']; ?>" class="form-control" required>
               </div>

               <a href="profile.php" class="btn btn-danger"> CANCEL </a>
               <button type="submit" name="updatebtnbook" class="btn btn-primary">UPDATE</button>
             </form>
             <?php
             }
           }
         ?>
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
