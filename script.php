<?php
    if(!isset($_SESSION))
    {
        include("security.php");
    }
?>
<?php

$connection = mysqli_connect("localhost","root","","boi");


  if(isset($_POST['registerbtnbook']))
  {
      $user=$_SESSION['user_id'];
      $book = $_POST['book'];
      $author = $_POST['authorselect'];
      $category=$_POST['category'];
      $price = $_POST['price'];
      $details = $_POST['details'];
      $location = $_POST['location'];

      date_default_timezone_set("Asia/Dhaka");
      $datetime = '';
      $datetime=date('Y-m-d H:i:s');
      $query = "INSERT INTO books (name,author,owner_id,category,price,present_condition,location,status,created_date,updated_date)
      VALUES ('$book','$author','$user','$category','$price','$details','$location','1','$datetime','$datetime')";
      $query_run = mysqli_query($connection, $query);

      $last_id = mysqli_insert_id($connection);
      $target_dir2="";
      if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
      {
        $target_dir2="images/default-image.jpg";
      }
      else{
        $error=array();
        $extension=array("jpeg","jpg","png","gif");
        $i=0;

        foreach($_FILES["file_upload"]["tmp_name"] as $key=>$tmp_name) {
          $i++;
              $file_name=$_FILES["file_upload"]["name"][$key];
              $t=rand();
              $st=strval($t);
              $userFileName='book_pic_'.$st.$file_name;
              $file_tmp=$_FILES["file_upload"]["tmp_name"][$key];
              $ext=pathinfo($file_name,PATHINFO_EXTENSION);
              $target_dir2="images/books/".$userFileName;
              if(in_array($ext,$extension)) {
                  if(!file_exists("images/books/".$userFileName)) {
                      move_uploaded_file($file_tmp=$_FILES["file_upload"]["tmp_name"][$key],"images/books/".$userFileName);
                      date_default_timezone_set("Asia/Dhaka");
                      $datetime = '';
                      $datetime=date('Y-m-d H:i:s');
                      if($i==1)
                      {
                        $query2 = "Update books set image='$target_dir2' where book_id='$last_id'";
                        $query_run2 = mysqli_query($connection, $query2);
                      }
                      $query1 = "INSERT INTO images (book_id,image,status,created_date,updated_date)
                      VALUES ('$last_id','$target_dir2','1','$datetime','$datetime')";
                      $query_run1 = mysqli_query($connection, $query1);
                  }
                  else {
                  }
              }
              else {
                  array_push($error,"$file_name, ");
              }
      }

      if($query_run)
      {
          echo "done";
          $_SESSION['success'] =  "Book is Added Successfully";
          header('Location: profile.php');
      }
      else
      {
          echo "not done";
          $_SESSION['status'] =  "Book is Not Added";
          header('Location: profile.php');
      }

  }
}




?>
