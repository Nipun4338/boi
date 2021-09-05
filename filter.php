<?php
session_start();
ob_start();
include('database/dbconfig.php');
$sql="";
$category="";
$author="";
if(!empty($_GET["category"])){
$category = $_GET["category"];
  $sql="SELECT * FROM books where category='$category'";
}
else {
  $car=1;
}

if(!empty($_GET["author"])){
$author = $_GET["author"];
  $sql="SELECT * FROM books where author='$author'";
}
else {
  $car=1;
}

if(!empty($_GET["author"]) && !empty($_GET["authorsort"])){
$author = $_GET["author"];
  $sql="SELECT * FROM books where author='$author'";
}
else {
  $car=1;
}

if(!empty($_GET["booksort"]) && !empty($_GET["author"])){
$sort = $_GET["booksort"];
$author = $_GET["author"];
  if($sort=="asc")
  {
    $sql="SELECT * FROM books where author='$author' order by name";
  }
  else if($sort=="desc")
  {
    $sql="SELECT * FROM books where author='$author' order by name desc";
  }
}
else {
  $car=1;
}

if(!empty($_GET["pricesort"]) && !empty($_GET["author"])){
$sort = $_GET["pricesort"];
$author = $_GET["author"];
  if($sort=="asc")
  {
    $sql="SELECT * FROM books where author='$author' order by price";
  }
  else if($sort=="desc")
  {
    $sql="SELECT * FROM books where author='$author' order by price desc";
  }
}
else {
  $car=1;
}


if(!empty($_GET["booksort"]) && !empty($_GET["category"])){
$sort = $_GET["booksort"];
$category = $_GET["category"];
  if($sort=="asc")
  {
    $sql="SELECT * FROM books where category='$category' order by name";
  }
  else if($sort=="desc")
  {
    $sql="SELECT * FROM books where category='$category' order by name desc";
  }
}
else {
  $car=1;
}

if(!empty($_GET["authorsort"]) && !empty($_GET["category"])){
$sort = $_GET["authorsort"];
$category = $_GET["category"];
  if($sort=="asc")
  {
    $sql="SELECT * FROM books where category='$category' order by author";
  }
  else if($sort=="desc")
  {
    $sql="SELECT * FROM books where category='$category' order by author desc";
  }
}
else {
  $car=1;
}

if(!empty($_GET["pricesort"]) && !empty($_GET["category"])){
$sort = $_GET["pricesort"];
$category = $_GET["category"];
  if($sort=="asc")
  {
    $sql="SELECT * FROM books where category='$category' order by price";
  }
  else if($sort=="desc")
  {
    $sql="SELECT * FROM books where category='$category' order by price desc";
  }
}
else {
  $car=1;
}

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
		<title>Filter | বই</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale = 1.0">
		<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	  <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Iconsmind-Outline-Books-2.ico">



		<!-- Bootstrap Stylesheet -->
<link rel="stylesheet" href="/path/to/bootstrap.min.css" />
<!-- Bootstrap JS -->
<script src="/path/to/jquery.min.js"></script>
<script src="/path/to/bootstrap.min.js"></script>
<!-- <a href="https://www.jqueryscript.net/tags.php?/Carousel/">Carousel</a> Extension -->
<script src="carousel.js"></script>



<style type="text/css">
.center {
  text-align: center;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
/*----  Main Style  ----*/
#cards_landscape_wrap-2{
  text-align: center;
  background: #F7F7F7;
}
#cards_landscape_wrap-2 .container{
  padding-top: 80px;
  padding-bottom: 100px;
}
#cards_landscape_wrap-2 a{
  text-decoration: none;
  outline: none;
}
#cards_landscape_wrap-2 .card-flyer {
  border-radius: 5px;
}
#cards_landscape_wrap-2 .card-flyer .image-box{
  background: #ffffff;
  overflow: hidden;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.50);
  border-radius: 5px;
}
#cards_landscape_wrap-2 .card-flyer .image-box img{
  -webkit-transition:all .9s ease;
  -moz-transition:all .9s ease;
  -o-transition:all .9s ease;
  -ms-transition:all .9s ease;
  width: 100%;
  height: 200px;
}
#cards_landscape_wrap-2 .card-flyer:hover .image-box img{
  opacity: 0.7;
  -webkit-transform:scale(1.15);
  -moz-transform:scale(1.15);
  -ms-transform:scale(1.15);
  -o-transform:scale(1.15);
  transform:scale(1.15);
}
#cards_landscape_wrap-2 .card-flyer .text-box{
  text-align: center;
}
#cards_landscape_wrap-2 .card-flyer .text-box .text-container{
  padding: 30px 18px;
}
#cards_landscape_wrap-2 .card-flyer{
  background: #FFFFFF;
  margin-top: 50px;
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  -ms-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
  box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
}
#cards_landscape_wrap-2 .card-flyer:hover{
  background: #fff;
  box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50);
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  -ms-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
  margin-top: 50px;
}
#cards_landscape_wrap-2 .card-flyer .text-box p{
  margin-top: 10px;
  margin-bottom: 0px;
  padding-bottom: 0px;
  font-size: 14px;
  letter-spacing: 1px;
  color: #000000;
}
#cards_landscape_wrap-2 .card-flyer .text-box h6{
  margin-top: 0px;
  margin-bottom: 4px;
  font-size: 18px;
  font-weight: bold;
  text-transform: uppercase;
  font-family: 'Roboto Black', sans-serif;
  letter-spacing: 1px;
  color: #00acc1;
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

a:link {
  color: green;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: red;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: blue;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: yellow;
  background-color: transparent;
  text-decoration: underline;
}

    </style>
</head>


<body style="background:#fff">
  <?php
  include('includes/nav.php');
   ?>
   <h6 style="text-align:center">Found <?php echo $noOfRows; ?> result/s.</h6>

   <div class="container" style="padding:0 0 40px 0">
     <div class="row">
       <div class="col-md-3 card-body shadow-lg p-3 mb-5 rounded" style="background:#eee;text-shadow: black 0.05em 0.05em 0.1em;">
         <h5 class="" style="text-shadow: black 0.1em 0.1em 0.2em;padding: 5px;border-bottom:1px dotted #000">SORT</h5>
         <ul class="items">
           <li class="align-items-center">
             <a href="filter?category=<?php echo $category; ?>&author=<?php echo $author; ?>&booksort=asc" >Book Name - Ascending</a>
           </li>
           <li class="align-items-center">
             <a href="filter?category=<?php echo $category; ?>&author=<?php echo $author; ?>&booksort=desc" >Book Name - Descending</a>
           </li>
           <li class="align-items-center">
             <a href="filter?category=<?php echo $category; ?>&author=<?php echo $author; ?>&authorsort=asc" >Author Name - Ascending</a>
           </li>
           <li class="align-items-center">
             <a href="filter?category=<?php echo $category; ?>&author=<?php echo $author; ?>&authorsort=desc" >Author Name - Descending</a>
           </li>
           <li class="align-items-center">
             <a href="filter?category=<?php echo $category; ?>&author=<?php echo $author; ?>&pricesort=asc" >Price - Low to High</a>
           </li>
           <li class="align-items-center">
             <a href="filter?category=<?php echo $category; ?>&author=<?php echo $author; ?>&pricesort=desc" >Price - High to Low</a>
           </li>
         </ul>
       </div>

      <div class="col-md-9">
        <div class="container">
          <div class="row">


   <?php

   foreach($data as $row1){
   ?>

   <div  class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

       <div  id="cards_landscape_wrap-2" >
         <!-- counter for chart-->

           <a href="book?book=<?php echo $row1['book_id']?>">
               <div class="card-flyer">
                   <div class="text-box">
                       <div class="image-box">
           <img style="height: 50px; width: 50px;object-fit: cover;"class="img-fluid" src="<?php echo $row1['image'];?>" alt="alt" >
           </div>
           <div class="text-container">
           <h6 style="font-weight: bold;"><?php echo $row1['name'];?></h6>
           <p><?php echo $row1['author'];?></p>
           <p style="font-weight: bold;">TK. <?php echo $row1['price'];?></p>
           <p><?php echo $row1['location'];?></p>
          </div>
          </div>
          </div>
          </a>

      </div>
    </div>

   <?php } ?>

</div>
</div>
</div>
     </div>
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
