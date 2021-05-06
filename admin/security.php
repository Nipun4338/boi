<?php
session_start();
include('database/dbconfig.php');
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}

if($_SESSION['username']!="nipun4338@gmail.com")
{
    header('Location: login.php');
}
?>
