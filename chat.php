<?php
include("security.php");
include('database/dbconfig.php');
?>

<!DOCTYPE html>
<html>
<head>
		<title>Chat | বই</title>
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
    margin: 0px 0 20px 0;
}

.sidenav {
  width: 130px;
  position: fixed;
  z-index: 1;
  overflow-x: hidden;
	border-left: 6px solid green;
  padding: 8px 0;
}


    </style>
</head>

<body style="background: whitesmoke;">

  <?php
  include('includes/nav.php');
   ?>
	 <article>
	 <div class="hello">
 	<div class="container-fluid">
     <div class="row">
     <div class="col-3" style="border-right: 3px solid #cecece">
       <div class="sidebar-item">
         <div class="sidenav">
					 <h1><?php echo $_SESSION["receive_name"]; ?></h1>
 				</div>
 			</div>
 		</div>
 		<div class="col-9">
			<div class="content-section">
<script type="text/javascript">
function scrollToBottom() {
        window.scrollTo(0, document.body.scrollHeight);
    }
    history.scrollRestoration = "manual";
    window.onload = scrollToBottom;
</script>
<?php
$user = $_SESSION['user_id'];
$receiver=$_SESSION["receive"];
unset($row1);
unset($row);
$m='';
$m1='';
$m="zmessage_";
$m.=$user;
$m1="zmessage_";
$m1.=$receiver;
if(isset($_POST['commenton']))
{
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $message1=htmlspecialchars($_POST["commenton"]);
  $sql2="insert into $m(message,sendto,type,date)
  values('$message1','$receiver','send','$datetime')";
  $result2=mysqli_query($link,$sql2) or die(mysqli_error($link));
	$sql2="insert into $m1(message,sendto,type,date)
  values('$message1','$user','receive','$datetime')";
  $result2=mysqli_query($link,$sql2) or die(mysqli_error($link));

}

$sql = "SELECT * from $m where sendto='$receiver'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
   if (strpos($row["type"],"receive")!== false) {
?>

<div  class="container1" style="background:#fff;margin-right:25%">
  <h6 style="font-weight:bold;color:#a08"><?php echo $_SESSION["receive_name"] ?></h6>
<p style="font-size:20px;font-family:Helvetica"><?php echo $row["message"] ?></p>
<span class="time-right"><?php echo date('M j, Y g:i A', strtotime($row["date"])); ?></span>
</div>
<?php }else{ ?>
<div  class="container1" style="background:#fff;margin-left:25%" >
<p style="text-align:right;font-size:20px;font-family:Helvetica"><?php echo $row["message"] ?></p>
<span class="time-right"><?php echo date('M j, Y g:i A', strtotime($row["date"])); ?></span>
</div>
<?php
}} }
else {
echo "0 Results";
} ?>

<form class="form-container" action="chat" method="POST" enctype="multipart/form-data">
<textarea class="form-control" rows="2" style="width:100%" name="commenton" placeholder="Enter text here..."></textarea>
<input type="submit" name="submit" class="btn btn-primary" value="SEND"  style="float:right"/>
</form>
<script type="text/javascript">
$(document).ready(function() {
  $('input[type="submit"]').attr('disabled', true);

  $('textarea').on('keyup',function() {
      var textarea_value = $("#texta").val();

      if(textarea_value != '') {
          $('input[type="submit"]').attr('disabled', false);
      } else {
          $('input[type="submit"]').attr('disabled', true);
      }
  });
});
</script>
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

</div>
</div>
</div>
</div>
</div>

</article>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
   </body>

<div class="progress-container fixed-bottom">
 <div class="progress-bar" id="myBar">
   </div>
</div>
<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}
</script>
