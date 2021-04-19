
<?php session_start(); ?>
<?php
include('database/dbconfig.php');
if(!empty($_GET["page"])){
$page=$_GET["page"];
}
else {
  $page=1;
}
if($page=="" || $page==1)
{
  $page1=0;
}
else {
  $page1=($page*16)-16;
}
$sql="";
$sql="SELECT * FROM books where status=1 limit $page1,16";
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
shuffle($data);
$sql='SELECT * FROM books where status=1';
$result2=mysqli_query($link,$sql) or die(mysqli_error($link));
$noOfRows2=mysqli_num_rows($result2);
$a=$noOfRows2/16;
$a=ceil($a);

/*$sql="SELECT * FROM slider2";
$result=mysqli_query($link,$sql);
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){
    if($row['status']==1)
    {
      /*echo "<pre>";
      print_r($row);*/
      //array_push($data,$row);
      //echo "</pre>";
    /*}
  }
}*/

if(isset($_REQUEST['advancesearch']))
{
  unset($data);
  $book=$_POST["book"];
  $author=$_POST["author"];
  $min=$_POST["min"];
  $max=$_POST["max"];
  if($book!="" || $author!="" || $min!="" || $max!="")
  {
    $sql="";
    if($min=="")
    {
      $min=-1;
    }
    if($max=="")
    {
      $max=-1;
    }
    if($book=="" && $author!="")
    {
      $sql="SELECT * FROM books where status=1 AND price BETWEEN '$min' AND '$max' And author LIKE '$author%'";
    }
    else if($book!="" && $author=="")
    {
      $sql="SELECT * FROM books where status=1 AND price BETWEEN '$min' AND '$max' And name LIKE '$book%'";
    }
    else {
      $sql="SELECT * FROM books where status=1 AND price BETWEEN '$min' AND '$max'";
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
  }
}

?>

<!DOCTYPE html>
<html>
<head>
		<title>Home | বই</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale = 1.0">
		<script src = "https://code.jquery.com/jquery-2.1.3.min.js"></script>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="A.assets,,_royalslider,,_royalslider.css+assets,,_royalslider,,_skins,,_default,,_rs-default.css+assets,,_royalslider,,_skins,,_minimal-white,,_rs-minimal-white.css+css,,_bootstrap.min.css+css,,_normalize.css+css,,_jquery-ui.css,Mcc.y-DhrddGnN.css.pagespeed.cf.Hfy0poW2iH.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Iconsmind-Outline-Books-2.ico">



<!-- <a href="https://www.jqueryscript.net/tags.php?/Carousel/">Carousel</a> Extension -->

<style>
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

</style>
<script src="carousel.js"></script>
</head>


<body>
  <?php
	include('includes/nav.php');
	 ?>

   <style type="text/css">h2{color: #ffff;}</style>
   <?php $sql="SELECT * FROM category";
   $result1=mysqli_query($link,$sql) or die(mysqli_error($link));
   $data1=array();
   $noOfRows1=mysqli_num_rows($result1);
   if($noOfRows1){
     while($row1=mysqli_fetch_assoc($result1)){

         array_push($data1,$row1);

     }
   }
   shuffle($data1);
    ?>
   <section id="home-featured">
    <div class="container-fluid">
           <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12">
                   <div class="container-fluid">
       <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="4000">
           <div class="carousel-inner row w-100 mx-auto" role="listbox">

             <div class="carousel-item active">
             <?php
             $r=1;
               foreach ($data1 as $row1) {
                 // code...
                 if($r%7==0) {
            echo '</div><div class="carousel-item">';
        }
              ?>

                 <div class="col-lg-2 col-md-6">
                     <img class="img-fluid" src="<?php echo $row1['image'];?>" style='height: 50px; width: 50px; object-fit: cover'>
                     <a><?php echo $row1['name'];?></a>
                 </div>

             <?php
               $r++;}
              ?>
              </div>
           </div>
           <a class="carousel-control-prev bg-dark w-auto" href="#carouselExample" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>

           </a>
           <a class="carousel-control-next bg-dark w-auto" href="#carouselExample" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>

           </a>
       </div>
   </div>


   	<!--scripts loaded here-->
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

               </div>
           </div>
       </div>
   </section>

   <div class="container-fluid">
   <div class="row">
       <div class="col-md-3 col-lg-3" >
         <h1 style="text-align:center;">Filter</h1>

         <h1 style="text-align:center;">Search Filter</h1>
         <div style="border-right:2px solid #eee">
           <form class="form-horizontal" action="index.php" method="POST">
             <div class="form-group">
               <label class="col-lg-11 control-label">Book Name</label>
               <div class="col-lg-11">
                 <input type="text" class="form-control" name="book" placeholder="Book Name">
               </div>
               <label class="col-lg-11 control-label">Author Name</label>
               <div class="col-lg-11">
                 <input type="text" class="form-control" name="author" placeholder="Author Name">
               </div>
               <label class="col-lg-11 control-label">Price Range</label>

                 <div class="col-lg-11"  >
                   <input type="number" class="form-control" name="min" placeholder="Minimum" required>
                 </div>
                 <div class="col-lg-11"  >
                   <input type="number" class="form-control" name="max" placeholder="Maximum" required>
                 </div>
                 <div class="form-group" style="display: flex;justify-content: center;padding:10px">
              <input type="submit" name="advancesearch" value="Search" class="btn btn-success" />
            </div>


             </div>
           </form>
         </div>
       </div>
       <div class="col-md-9">
         <div class="container">
           <div class="row">
             <div class="center">
             <div class="pagination" style="padding: 10px">
               <?php
               if($page>=2)
               {
                 ?><a href="index.php?page=<?php echo $page-1; ?>">&laquo;</a>
                 <?php
               }
               ?>
           <?php
             $c=0;
             for($b=1; $b<=$a; $b++)
             {
               if($b==$page)
               {

                 ?><a  class="active" href="index.php?page=<?php echo $b; ?>" style="text-decoration: none"><?php echo $b," "; ?></a><?php
               }
               else if($page=="" && $c==0)
               {
                 ?><a  class="active" href="index.php?page=<?php echo $b; ?>" style="text-decoration: none"><?php echo $b," "; ?></a><?php
                 $c=1;
               }
               else {
                 ?><a href="index.php?page=<?php echo $b; ?>" style="text-decoration: none"><?php echo $b," "; ?></a><?php
               }
             }

              ?>
              <?php
              if($page<$a)
              {
                ?><a href="index.php?page=<?php echo $page+1; ?>">&raquo;</a>
                <?php
              }
              ?>

            </div>
           </div>

           </div>

         </div>
         <div class="container" style="padding:0 0 40px 0">
           <div class="row">

 <?php

         foreach($data as $row1){
         ?>

         <div  class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

             <div  id="cards_landscape_wrap-2">

                 <a href="book.php?book=<?php echo $row1['book_id']?>">
                     <div class="card-flyer">
                         <div class="text-box">
                             <div class="image-box">
                 <img style="width: 100%;height: 15vw;object-fit: cover;"class="card-img card-img-bottom img-fluid" src="<?php echo $row1['image'];?>" alt="alt" >
                 </div>
                 <div class="text-container">
                 <h6 style="font-weight: bold;"><?php echo $row1['name'];?></h6>
                 <p><?php echo $row1['author'];?></p>
                 <p style="font-weight: bold;">TK. <?php echo $row1['price'];?></p>
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
