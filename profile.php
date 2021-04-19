<?php
include("security.php");
?>
<?php
$host="us-cdbr-east-03.cleardb.com";
$user="ba1268b5ca99c6";
$password="557bfa4e";
$db="heroku_923aa6dacc1b73c";

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
      $user=$_SESSION["user_id"];
		}
			?>
			</div>
		</div>
	</div>
	</section>

  <div class="container-fluid" style="text-align:center;margin-top:10px">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Book By You
      </h6>
    </div>

    <div class="card-body">
      <?php
      if(isset($_SESSION['success']) && $_SESSION['success']!='')
      {
        echo '<h2>'.$_SESSION['success'].'</h2>';
        unset($_SESSION['success']);
      }
      if(isset($_SESSION['status']) && $_SESSION['status']!='')
      {
        echo '<h2 class="bg-info">'.$_SESSION['status'].'</h2>';
        unset($_SESSION['status']);
      }
       ?>

      <div class="table-responsive">
        <?php
        $connection = mysqli_connect("localhost","root","","boi");
        $query1 = "SELECT * FROM books where owner_id='$user'";
        $query_run1 = mysqli_query($connection, $query1);
    ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th> Book Name </th>
              <th>Author</th>
              <th>Price</th>
              <th>Details</th>
              <th>Location</th>
              <th>Created Date</th>
              <th>EDIT </th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody>
            <?php

                          if(mysqli_num_rows($query_run1) > 0)
                          {
                              while($row = mysqli_fetch_assoc($query_run1))
                              {
                          ?>
                              <tr>
                                  <td><a href="book.php?book=<?php echo $row["book_id"] ?>">	<?php echo $row["name"] ?></a></td>
                                  <td><?php  echo $row['author']; ?></td>
                                  <td><?php  echo $row['price']; ?></td>
                                  <td><?php  echo $row['present_condition']; ?></td>
                                  <td><?php  echo $row['location']; ?></td>
                                  <td><?php echo date('M j, Y g:i A', strtotime($row["created_date"]));  ?></td>
                                  <td>
                                      <form action="book_edit.php" method="post">
                                          <input type="hidden" name="edit_id_book" value="<?php echo $row['book_id']; ?>">
                                          <button type="submit" name="edit_btn_book" class="btn btn-success"> EDIT</button>
                                      </form>
                                  </td>
                                  <td>
                                    <form action="script.php" method="post">
                                        <input type="hidden" name="delete_book" value="<?php echo $row['book_id']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>

                                    </form>
                                </td>
                              </tr>
                          <?php
                              }
                          }
                          else {
                              echo "No Record Found";
                          }
                          ?>

          </tbody>
        </table>
        *Once deleted, it can not be undone.

      </div>
    </div>
  </div>

  </div>
  <!-- /.container-fluid -->

</body>

<div class="progress-container fixed-bottom">
  <div class="progress-bar" id="myBar">
    </div>
</div>
<?php
include('includes/footer.php');
 ?>
