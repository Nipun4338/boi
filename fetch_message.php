<?php
include("security.php");
include('database/dbconfig.php');

//fetch_comment.php
$user = $_SESSION['user_id'];
$receiver=$_SESSION["receive"];

$m="zmessage_";
$m.=$user;
$m1="zmessage_";
$m1.=$receiver;
$output = '';
$sql = "SELECT * from $m where sendto='$receiver'";
$result = mysqli_query($link, $sql);
$data=array();
if (mysqli_num_rows($result) > 0) {
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
   array_push($data,$row);
 }
}
else {
  $output .='0 Results';
}
 foreach($data as $row)
 {
   if ($row["type"]=="receive") {
     $output .='<div  class="container1" style="background:#fff;">
       <h6 style="font-weight:bold;color:#a08">'.$_SESSION["receive_name"].'</h6>
     </div>';

   }
   else {

   }
 }


echo json_encode($output);


?>
