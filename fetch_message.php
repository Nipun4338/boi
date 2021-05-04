<?php
include("security.php");
include('database/dbconfig.php');

//fetch_comment.php
$user = $_SESSION['user_id'];
$receiver=$_SESSION["receive"];
$query = "
INSERT INTO comments
(comment)
VALUES ('do')
";
$statement = $connection->prepare($query);
$statement->execute();
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
   if (strpos($row["type"],"receive")!== false) {
     $output .='<div  class="container1" style="background:#fff;">
       <h6 style="font-weight:bold;color:#a08">'.$_SESSION["receive_name"].'</h6>
     <p style="font-size:rfs-fluid-value(1.125rem);font-family:Helvetica">'.html_entity_decode(nl2br($row["message"])).'</p>
     <span style="font-size:12px;font-family:Helvetica" class="time-right">'.date("M j, Y g:i A", strtotime($row["date"])).'</span>
     </div>';
   }
   else {
     $output .='<div  class="container2" style="background:#fff;" >
     <p style="font-size:rfs-fluid-value(1.125rem);font-family:Helvetica">'.html_entity_decode(nl2br($row["message"])).'</p>
     <span style="font-size:12px;font-family:Helvetica" class="time-right">'.date("M j, Y g:i A", strtotime($row["date"])).'</span>
     </div>';
   }
 }


echo json_encode($output);


?>
