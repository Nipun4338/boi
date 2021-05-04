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
	float:  left;
  clear: both;
	max-width: 70%;
	overflow-wrap: anywhere;
}
.container2 {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
	float:  right;
  clear: both;
	max-width: 70%;
	overflow-wrap: anywhere;
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

.container2::after {
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
					 <h3><?php echo $_SESSION["receive_name"]; ?></h3>
 				</div>
 			</div>
 		</div>
 		<div class="col-9">
			<div class="content-section">
<div id="display_comment"></div>
</div>
<form class="form-container" id="message_form" method="POST">
<div class="form-group">
<textarea class="form-control" rows="2" style="width:100%" name="commenton" id="commenton" placeholder="Enter text here..."></textarea>
</div>
<div class="form-group">
<input type="submit" name="submit" id="submit" class="btn btn-primary" value="SEND"  style="float:right">
</div>
</form>

<script>
$(document).ready(function(){

$('#message_form').on('submit', function(event){
event.preventDefault();
var form_data = $(this).serialize();
	$.ajax({
		url:"add_message.php",
		method:"POST",
		data:form_data,
		dataType:"json",
		success:function(data)
		{
			if(data.error != '')
	    {
	     $('#message_form')[0].reset();
	     load_message();
	    }
		}
		//$('#message_form')[0].reset();
	})
});
load_message();

function load_message()
{
 $.ajax({
	url:"fetch_message.php",
	method:"POST",
	data:{ user_id : <?php echo $_SESSION["user_id"]; ?> },
	dataType:'json',
	success:function(data)
	{
	 $('#display_comment').html(data);
	  window.scrollTo(0, document.body.scrollHeight);

	}
 })
}

});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('input[type="submit"]').attr('disabled', true);

  $('textarea').on('keyup',function() {
      var textarea_value = $("#commenton").val();

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
