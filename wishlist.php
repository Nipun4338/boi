
<?php
include("security.php");
$host="localhost";
$user="root";
$password="";
$db="boi";

$link=mysqli_connect($host,$user,$password,$db);
if(isset($_SESSION["username"]) && isset($_GET["book"]))
{
  $user=$_SESSION["user_id"];
  $book=$_GET["book"];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $sql="SELECT * from wishlist where book_id='$book' and user_id='$user'";
  $result=mysqli_query($link,$sql) or die(mysqli_error($link));
  $noOfRows=mysqli_num_rows($result);
  if($noOfRows>0)
  {
    echo "Book already inserted!";
  }
  else {
    $sql1="insert into wishlist(book_id,user_id,status,created_date,updated_date)
    values('$book','$user','1','$datetime','$datetime')";
    $result1=mysqli_query($link,$sql1) or die(mysqli_error($link));
  }

}
else if(!isset($_SESSION["username"])) {
header('location:login.php');
}

if(isset($_REQUEST['delete']))
{
  $book=$_POST["book_id"];
  $user=$_SESSION["user_id"];
  $sql="DELETE from wishlist where book_id='$book' and user_id='$user'";
  $result=mysqli_query($link,$sql) or die(mysqli_error($link));
}
?>


<!DOCTYPE html>
<html>
<head>
		<title>Wishlist | বই</title>
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



<!-- <a href="https://www.jqueryscript.net/tags.php?/Carousel/">Carousel</a> Extension -->

<style>

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
    margin: 120px 0 120px 0;
}

</style>
<script src="carousel.js"></script>
</head>


<body>
  <?php
	include('includes/nav.php');
	 ?>
   <div class="hello">

     <div class="container-fluid" style="text-align:center">

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
       <div class="card-header py-3">
         <h1 class="m-0 font-weight-bold text-primary">My Wishlist
         </h1>
       </div>

       <div class="card-body">


         <div class="table-responsive">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
             <thead>
   					<tr>
   						<th>Book Name</th>
              <th>Author</th>
   						<th>Price</th>

   						<th>Date and Time</th>
   						<th>Action</th>
   					</tr>
   				</thead>
   				<tbody>
   				<?php
   				$c_id = $_SESSION['user_id'];

   				$sql = "SELECT wishlist.wishlist_id as wishlist_id, wishlist.book_id as book_id, books.name as name, books.author as author
          , wishlist.created_date as wishlist_date, books.price as price FROM wishlist JOIN books on books.book_id=wishlist.book_id WHERE wishlist.user_id='$c_id'";
   				$result2 = mysqli_query($link, $sql);

   				if (mysqli_num_rows($result2) > 0) {
   				 // output data of each row
   				 while($row = mysqli_fetch_assoc($result2)) {
    			?>
   					<tr>
   						<td>
                           <a href="book.php?book=<?php echo $row["book_id"] ?>">	<?php echo $row["name"] ?></a>

   						</td>
              <td>
   						<?php echo $row["author"] ?>
   						</td>
   						<td>
   						<?php echo $row["price"] ?>
   						</td>

   						<td>


   						<?php echo date('M j, Y g:i A', strtotime($row["wishlist_date"]));  ?>
   						</td>
   						<td>
                <form class="form-container" action="wishlist.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="book_id" value="<?php echo $row["book_id"] ?>">
   							 <button type="submit" id="submit" name="delete"  class="btn btn-primary btn-block submit2">DELETE</button>
              </form>

   						</td>
   					</tr>


   			<?php
   				}
   			   } else {
   				 echo "0 results";
   			   }


   			 ?>
       </tbody>
   			</table>
      </div>
    </div>
  </div>

  </div>
   </div>

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
