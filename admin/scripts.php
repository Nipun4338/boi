<?php
    if(!isset($_SESSION))
    {
        include("security.php");
    }
?>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>


  <?php

$connection = mysqli_connect("localhost","root","","carhub");

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = $_POST['confirmpassword'];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    if($password == $confirm_password)
    {
	      $password=md5($password);
        $query = "INSERT INTO adminpanel (username,email,password,status,created_date,updated_date) VALUES ('$username','$email','$password',1,'$datetime','$datetime')";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo "done";
            $_SESSION['success'] =  "Admin is Added Successfully";
            header('Location: register.php');
        }
        else
        {
            echo "not done";
            $_SESSION['status'] =  "Admin is Not Added";
            header('Location: register.php');
        }
    }
    else
    {
        echo "pass no match";
        $_SESSION['status'] =  "Password and Confirm Password Does not Match";
        header('Location: register.php');
    }

}

if (isset($_POST["updatebtn"])) {
  $id=$_POST['edit_id'];
  $username=$_POST['edit_username'];
  $email=$_POST['edit_email'];
  $password=md5($_POST['edit_password']);
  $status=$_POST['edit_status'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update adminpanel set username='$username',email='$email',password='$password',status='$status', updated_date='$datetime' where admin_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Your data is updated";
    header('Location: register.php');
  }
  else {
    $_SESSION['success']="Your data is not updated";
    header('Location: register.php');
  }
}


  if(isset($_POST['registerbtncar']))
  {
      $name = $_POST['car_name'];
      $brand = $_POST['brandselect'];
      $model = $_POST['car_model'];
      $seats = $_POST['car_seats'];
      $build = $_POST['car_build'];
      $cost = $_POST['car_cost'];
      $color = $_POST['car_color'];
      $details = $_POST['car_details'];
      $status = $_POST['status'];

      $target_dir2="";
      if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
      {
        $target_dir2="images/cars/default-image.jpg";
      }
      else{

        $userFileName='car_pic_'.$name;
         $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
         $target_dir="../images/cars/".$userFileName.".".$imageType;
         $target_dir2="images/cars/".$userFileName.".".$imageType;
         $target_file=$target_dir;
         $temp_file=$_FILES['file_upload']['tmp_name'];
         move_uploaded_file($temp_file, $target_file);
      }



      date_default_timezone_set("Asia/Dhaka");
      $datetime = '';
      $datetime=date('Y-m-d H:i:s');
      $query = "INSERT INTO cars (car_name,car_brand_id,car_model,car_image,car_seats,car_build,car_cost,car_color,car_details,status,created_date,update_date)
      VALUES ('$name','$brand','$model','$target_dir2','$seats','$build','$cost','$color','$details','$status','$datetime','$datetime')";
      $query_run = mysqli_query($connection, $query);

      if($query_run)
      {
          echo "done";
          $_SESSION['success'] =  "Car is Added Successfully";
          header('Location: registercar.php');
      }
      else
      {
          echo "not done";
          $_SESSION['status'] =  "Car is Not Added";
          header('Location: registercar.php');
      }

  }

  if (isset($_POST["updatebtncar"])) {
    $id=$_POST['edit_id_car'];
    $name = $_POST['edit_car_name'];
    $brand = $_POST['edit_brand'];
    $model = $_POST['edit_car_model'];
    $seats = $_POST['edit_car_seats'];
    $image = $_POST['edit_image'];
    $build = $_POST['edit_car_build'];
    $cost = $_POST['edit_car_cost'];
    $color = $_POST['edit_car_color'];
    $details = $_POST['edit_car_details'];
    $status = $_POST['edit_status'];
    $target_dir2="";
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
    {
      $target_dir2=$image;
    }
    else{

      $userFileName='car_pic_'.$name;
       $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
       $target_dir="../images/cars/".$userFileName.".".$imageType;
       $target_dir2="images/cars/".$userFileName.".".$imageType;
       $target_file=$target_dir;
       $temp_file=$_FILES['file_upload']['tmp_name'];
       move_uploaded_file($temp_file, $target_file);
    }
    $query="update cars set car_name='$name',car_brand_id='$brand',car_model='$model',car_seats='$seats',car_image='$target_dir2',car_build='$build',car_cost='$cost',car_color='$color',car_details='$details' ,status='$status', update_date='$datetime' where car_id='$id'";
    $query_run=mysqli_query($connection, $query);

    if($query_run)
    {
      $_SESSION['success']="Car data is updated";
      header('Location: registercar.php');
    }
    else {
      $_SESSION['success']="Car data is not updated";
      header('Location: registercar.php');
    }


}






if(isset($_POST['registerbtnteam']))
{
    $name = $_POST['team_name'];
    $aust = $_POST['aust_id'];
    $status = $_POST['status'];
    $target_dir2="";
    if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
    {
      $target_dir2="images/team/default-image.jpg";
    }
    else{

      $userFileName='team_pic_'.$name;
       $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
       $target_dir="../images/team/".$userFileName.".".$imageType;
       $target_dir2="images/team/".$userFileName.".".$imageType;
       $target_file=$target_dir;
       $temp_file=$_FILES['file_upload']['tmp_name'];
       move_uploaded_file($temp_file, $target_file);
    }
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $query = "INSERT INTO team (name,aust_id,image_path,status,created_date,updated_date)
    VALUES ('$name','$aust','$target_dir2','$status','$datetime','$datetime')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo "done";
        $_SESSION['success'] =  "Member is Added Successfully";
        header('Location: registerteam.php');
    }
    else
    {
        echo "not done";
        $_SESSION['status'] =  "Member is Not Added";
        header('Location: registerteam.php');
    }

}


if (isset($_POST["updatebtnteam"])) {
  $id=$_POST['edit_id_team'];
  $name=$_POST['edit_team_name'];
  $aust=$_POST['edit_aust_id'];
  $status=$_POST['edit_status'];
  $image=$_POST['edit_image'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
  {
    $target_dir2=$image;
  }
  else{

    $userFileName='team_pic_'.$name;
     $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
     $target_dir="../images/team/".$userFileName.".".$imageType;
     $target_dir2="images/team/".$userFileName.".".$imageType;
     $target_file=$target_dir;
     $temp_file=$_FILES['file_upload']['tmp_name'];
     move_uploaded_file($temp_file, $target_file);
  }
  $query="update team set name='$name',aust_id='$aust',image_path='$target_dir2',status='$status', updated_date='$datetime' where team_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Member data is updated";
    header('Location: registerteam.php');
  }
  else {
    $_SESSION['success']="Member data is not updated";
    header('Location: registerteam.php');
  }


}



if (isset($_POST["updatebtnuser"])) {
  $id=$_POST['edit_id_user'];
  $status=$_POST['edit_status'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update user set status='$status', updated_date='$datetime' where customer_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="User data is updated";
    header('Location: userinfo.php');
  }
  else {
    $_SESSION['success']="User data is not updated";
    header('Location: userinfo.php');
  }


}





if(isset($_POST['registerbtnbrand']))
{
    $name = $_POST['brand_name'];
    $status = $_POST['status'];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $query = "INSERT INTO brand (brand_name,status,created_date,updated_date)
    VALUES ('$name','$status','$datetime','$datetime')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo "done";
        $_SESSION['success'] =  "Brand is Added Successfully";
        header('Location: brand.php');
    }
    else
    {
        echo "not done";
        $_SESSION['status'] =  "Brand is Not Added";
        header('Location: brand.php');
    }

}


if (isset($_POST["updatebtnbrand"])) {
  $id=$_POST['edit_id_brand'];
  $name=$_POST['edit_brand_name'];
  $status=$_POST['edit_status'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  $query="update brand set brand_name='$name',status='$status', updated_date='$datetime' where brand_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Brand data is updated";
    header('Location: brand.php');
  }
  else {
    $_SESSION['success']="Brand data is not updated";
    header('Location: brand.php');
  }


}













if(isset($_POST['registerbtnslider1']))
{
    $header = $_POST['header'];
    $paragraph = $_POST['paragraph'];
    $status = $_POST['status'];
    $target_dir2="";
    if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
    {
      $target_dir2="images/team/default-image.jpg";
    }
    else{
      $name=$_FILES['file_upload']['name'];
      $userFileName='slider_pic_'.$name;
       $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
       $target_dir="../images/slides/".$userFileName;
       $target_dir2="images/slides/".$userFileName;
       $target_file=$target_dir;
       $temp_file=$_FILES['file_upload']['tmp_name'];
       move_uploaded_file($temp_file, $target_file);
    }
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $query = "INSERT INTO slider1 (header,paragraph,image,status,created_date,updated_date)
    VALUES ('$header','$paragraph','$target_dir2','$status','$datetime','$datetime')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo "done";
        $_SESSION['success'] =  "Image is Added Successfully";
        header('Location: slider1.php');
    }
    else
    {
        echo "not done";
        $_SESSION['status'] =  "Image is Not Added";
        header('Location: slider1.php');
    }

}


if (isset($_POST["updatebtnslider1"])) {
  $id=$_POST['edit_id_slider1'];
  $header=$_POST['edit_header'];
  $paragraph=$_POST['edit_paragraph'];
  $status=$_POST['edit_status'];
  $image=$_POST['edit_image'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
  {
    $target_dir2=$image;
  }
  else{

    $name=$_FILES['file_upload']['name'];
    $userFileName='slider_pic_'.$name;
     $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
     $target_dir="../images/slides/".$userFileName;
     $target_dir2="images/slides/".$userFileName;
     $target_file=$target_dir;
     $temp_file=$_FILES['file_upload']['tmp_name'];
     move_uploaded_file($temp_file, $target_file);
  }
  $query="update slider1 set header='$header',paragraph='$paragraph',image='$target_dir2',status='$status', updated_date='$datetime' where slider_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Slider data is updated";
    header('Location: slider1.php');
  }
  else {
    $_SESSION['success']="Slider data is not updated";
    header('Location: slider1.php');
  }


}









if(isset($_POST['registerbtnslider2']))
{

    $status = $_POST['status'];
    $target_dir2="";
    if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
    {
      $target_dir2="images/team/default-image.jpg";
    }
    else{
      $name=$_FILES['file_upload']['name'];
      $userFileName='slider_pic_'.$name;
       $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
       $target_dir="../assets/".$userFileName;
       $target_dir2="assets/".$userFileName;
       $target_file=$target_dir;
       $temp_file=$_FILES['file_upload']['tmp_name'];
       move_uploaded_file($temp_file, $target_file);
    }
    date_default_timezone_set("Asia/Dhaka");
    $datetime = '';
    $datetime=date('Y-m-d H:i:s');
    $query = "INSERT INTO slider2 (image,status,created_date,updated_time)
    VALUES ('$target_dir2','$status','$datetime','$datetime')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo "done";
        $_SESSION['success'] =  "Image is Added Successfully";
        header('Location: slider2.php');
    }
    else
    {
        echo "not done";
        $_SESSION['status'] =  "Image is Not Added";
        header('Location: slider2.php');
    }

}


if (isset($_POST["updatebtnslider2"])) {
  $id=$_POST['edit_id_slider2'];
  $status=$_POST['edit_status'];
  $image=$_POST['edit_image'];
  date_default_timezone_set("Asia/Dhaka");
  $datetime = '';
  $datetime=date('Y-m-d H:i:s');
  if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
  {
    $target_dir2=$image;
  }
  else{

    $name=$_FILES['file_upload']['name'];
    $userFileName='slider_pic_'.$name;
     $imageType=strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
     $target_dir="../assets/".$userFileName;
     $target_dir2="assets/".$userFileName;
     $target_file=$target_dir;
     $temp_file=$_FILES['file_upload']['tmp_name'];
     move_uploaded_file($temp_file, $target_file);
  }
  $query="update slider2 set image='$target_dir2',status='$status', updated_time='$datetime' where slider_id='$id'";
  $query_run=mysqli_query($connection, $query);

  if($query_run)
  {
    $_SESSION['success']="Slider data is updated";
    header('Location: slider2.php');
  }
  else {
    $_SESSION['success']="Slider data is not updated";
    header('Location: slider2.php');
  }


}

?>
