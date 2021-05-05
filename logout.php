<?php
session_start();
include('database/dbconfig.php');
//if(isset($_POST['logout_btn']))
  {
    $active="UPDATE user
    SET active_status = 'Offline'
    WHERE user_id=".$_SESSION['user_id'];
    $statement = $connection->prepare($active);
    $statement->execute();
    session_destroy();
    unset($_SESSION['username']);
header('Location: login');
  }

?>
