<?php
include("security.php");
include('database/dbconfig.php');
$sql = "SELECT * from comments";
$result = mysqli_query($link, $sql);
$data=array();
if (mysqli_num_rows($result) > 0) {
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
   array_push($data,$row);
 }
}
foreach($data as $row)
{
  echo $row["comment"];
}
?>
