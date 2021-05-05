
<?php
session_start();
include('database/dbconfig.php');
date_default_timezone_set("Asia/Dhaka");
$datetime = '';
$datetime=date('Y-m-d H:i:s');
//add_comment.php
$error = '';
$comment_name = '';
$comment_content = '';
$id=$_POST["comment_id"];
$book="zcomments_";
$book.=strval($_POST["book_id"]);

if(empty($_POST["comment"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else if(empty($_SESSION['username']))
{
  $error .= '<p class="text-danger">Login is required</p>';
}
else
{
 $comment_content = $_POST["comment"];
 $comment_name=$_SESSION['user_name'];
}

if($error == '')
{
  $sql="CREATE TABLE if not exists $book (
  comment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  parent_comment_id INT(6) NULL,
  comment TEXT NULL,
  sender_name TEXT NULL,
  status INT(6) NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL
  )";
  $result=mysqli_query($link,$sql) or die(mysqli_error($link));
 $query = "
 INSERT INTO $book
 (parent_comment_id, comment, sender_name,date)
 VALUES ('$id', '$comment_content', '$comment_name', '$datetime')
 ";
 $statement = $connection->prepare($query);
 $statement->execute();
 $error = '<p class="text-danger">Comment Added.</p>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
