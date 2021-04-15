<?php
include("security.php");

if (isset($_POST["login_btn"])) {
    $email_login=$_POST['email'];
    $password_login=md5($_POST['password']);
    $query="select * from adminpanel where email='$email_login' and password='$password_login'";
    $query_run=mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
      $_SESSION['username']=$email_login;
      header('Location: index.php');
    }
    else {
      $_SESSION['status']="Email id / Password is invalid";
      header('Location: login.php');
    }
  }


?>
