<?php
    if(!isset($_SESSION))
    {
        include("security.php");
    }
?>
<?php
include('database/dbconfig.php');


  if(isset($_POST['registerbtnbook']))
  {
      $user=$_SESSION['user_id'];
      $book = $_POST['book'];
      $author = $_POST['author'];
      $category=$_POST['category'];
      $price = $_POST['price'];
      $details = $_POST['details'];
      $location = $_POST['location'];

      date_default_timezone_set("Asia/Dhaka");
      $datetime = '';
      $datetime=date('Y-m-d H:i:s');
      $query = "INSERT INTO books (name,author,owner_id,category,price,present_condition,location,status,created_date,updated_date)
      VALUES ('$book','$author','$user','$category','$price','$details','$location','2','$datetime','$datetime')";
      $query_run = mysqli_query($connection, $query);

      $last_id = mysqli_insert_id($connection);
      $target_dir2="";
      if(empty($_POST["file"]))
      {
        $target_dir2="https://ucarecdn.com/4d13fbd1-4dbf-4fc3-8a56-3cbb8fba76e4/";
      }
      else{
        $target_dir2=$_POST["file"];
        $length=strlen($_POST["file"]);
        $count=(int)$_POST["file"][$length-2];
        for($x=0; $x<$count; $x++)
        {
          $target_dir2=$_POST["file"]."nth/".$x."/";
          date_default_timezone_set("Asia/Dhaka");
          $datetime = '';
          $datetime=date('Y-m-d H:i:s');
          $query2 = "Update books set image='$target_dir2' where book_id='$last_id'";
          $query_run2 = mysqli_query($connection, $query2);
          $query1 = "INSERT INTO images (book_id,image,status,created_date,updated_date)
          VALUES ('$last_id','$target_dir2','1','$datetime','$datetime')";
          $query_run1 = mysqli_query($connection, $query1);
        }
      if($query_run)
      {
          echo "done";
          $_SESSION['success'] =  "Book is Added Successfully";
          header('Location: profile');
      }
      else
      {
          echo "not done";
          $_SESSION['status'] =  "Book is Not Added";
          header('Location: profile');
      }

  }
}

if (isset($_POST["updatebtnbook"])) {
  $id=$_POST['edit_id_book'];
  $price=$_POST['edit_price'];
  $details=$_POST['edit_details'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update books set price='$price',present_condition='$details', updated_date='$datetime' where book_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Book is updated!";
    header('Location: profile');
  }
  else {
    $_SESSION['success']="Book is not updated!";
    header('Location: profile');
  }


}



if (isset($_POST["delete_btn"])) {
  $id=$_POST['delete_book'];
  $query="delete from books where book_id='$id'";
  $query_run=mysqli_query($connection, $query);
  $query="select image from images where book_id='$id'";
  $query_run=mysqli_query($connection, $query);
  $data=array();
  $noOfRows=mysqli_num_rows($query_run);
  if($noOfRows){
    while($row=mysqli_fetch_assoc($query_run)){

        unlink($row["image"]);

    }
  }

  $query="delete from images where book_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Book is deleted!";
    header('Location: profile');
  }
  else {
    $_SESSION['success']="Book is not updated!";
    header('Location: profile');
  }


}





?>
