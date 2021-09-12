
<?php
session_start();
ob_start();
include('database/dbconfig.php');
$book="";

if(!empty($_GET["book"])){
$book=$_GET["book"];
}
else {
  $car=1;
}

$sql="";

$sql="SELECT * FROM books where book_id='$book' and status='1'";

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
		<title>Book Details | বই</title>
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
          margin: 20px 0 20px;
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


* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
    </style>
</head>


<body style="background:#EEEEEE">
  <?php
  include('includes/nav.php');
   ?>
   <?php
   $sql3="SELECT * FROM images where book_id=$book";

   $result3=mysqli_query($link,$sql3) or die(mysqli_error($link));
   $data3=array();
   $noOfRows3=mysqli_num_rows($result3);
   if($noOfRows3){
     while($row3=mysqli_fetch_assoc($result3)){

         /*echo "<pre>";
         print_r($row);*/
         array_push($data3,$row3);
         //echo "</pre>";

     }
   }
   $i=0;
   ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-lg-6" style="margin: 15px 0px 15px 15px">
        <div class="row">
        <?php foreach ($data as $row) {
        ?>
        <?php foreach ($data3 as $row3) {
          $i++;
        ?>
        <div class="column" >
          <img src="<?php echo $row3['image']; ?>" style="width:100%" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor">
        </div>
      <?php } ?>
        </div>
<div id="myModal" class="modal">
  <div class="modal-content">
    <?php $j=0;
    foreach ($data3 as $row3) {
      $j++;
    ?>
    <div class="mySlides">
      <img src="<?php echo $row3['image']; ?>" style="width:100%">
      <div class="numbertext" style="font-weight:bold;font-size:20px"><?php echo $j; ?> / <?php echo $i; ?></div>
    </div>
    <?php } ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>
    <div class="row">


    <?php $k=0;
    foreach ($data3 as $row3) {

      $k++;
    ?>
    <div class="column">
      <img class="demo cursor" src="<?php echo $row3['image']; ?>" style="width:100%" onclick="currentSlide(<?php echo $k; ?>)" alt="">
    </div>
    <?php } ?>
    </div>
    <span class="close cursor" onclick="closeModal()">&times;</span>
  </div>
  </div>
  <script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>


        </div>
        <div class="col-md-5 col-lg-5 shadow-lg p-3 mb-5 bg-white rounded" style="text-align: center;">
          <h6 style="font-weight: bold;padding: 10px 10px 0px 10px; font-size: 25px"><?php echo $row['name'];?></h6>
          by <a href="filter?author=<?php echo $row['author'];?>" class="" ><?php echo $row['author'];?></a><br>
          <a href="filter?category=<?php echo $row['category'];?>" class="badge badge-pill badge-secondary" ><?php echo $row['category'];?></a>

          <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
              <ul class="info" style="text-align: left">
                <li>
                  <span style="font-weight: bold">Location:   </span>
                  <?php echo $row['location'];;?>

                </li>
                <li>
                  <span style="font-weight: bold">Details:   </span>
                  <?php echo $row['present_condition'];;?>

                </li>

            </ul>
            <form class="form-container" action="chat" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="user_id1" value="<?php echo $row["owner_id"] ?>">
              <?php $_SESSION["receive"]=$row["owner_id"];
                $receiver_id1=$_SESSION["receive"];
               ?>
              <?php
              $sql1 = "SELECT name,user_id from user where user_id='$receiver_id1'";
              $result1 = mysqli_query($link, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)) { ?>
                  <input type="hidden" name="user_name" value="<?php echo $row1["name"] ?>">
                	<?php $_SESSION["receive_name"]=$row1["name"];
                }}
                  ?>
            <button type="submit" onclick="document.location='chat'" class="btn btn-danger">Message to Owner</button>
          </form>
            <button style="margin:10px" onclick="document.location='wishlist?book=<?php echo $row['book_id'];?>'" class="btn btn-primary">Add to Wishlist</button>


            </div>
          </div>

        </div>

        <script type="text/javascript">
        const change = src => {
            document.getElementById('main').src = src;
        }
    </script>
      <?php } ?>

      </div>
    </div>
    <div class="shadow-lg" style="background:#fff; border:1px solid blue">
      <h1 style="margin:10px">Comments</h1>
      <div class="">
        <form class="" method="POST" id="comment_form" style="margin:10px">
          <div class="form-group">
            <textarea type="text" class="form-control" placeholder="Enter Comment..." rows="4" name="comment" id="comment"></textarea>
          </div>
          <div class="form-group" align="right">
            <input type="hidden" name="comment_id" id="comment_id" value="0" />
            <input type="hidden" name="book_id" id="book_id" value="<?php echo $book; ?>">
            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit">
          </div>
        </form>
        <span id="comment_message"></span>
         <br />
         <div id="display_comment"></div>
        </div>
      </div>
    </div>
    <script>
$(document).ready(function(){

 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:{ book_id : <?php echo $book; ?> },
   dataType:'json',
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }
 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment').focus();
 });
});
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>

    <div class="progress-container fixed-bottom">
      <div class="progress-bar" id="myBar">
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>
