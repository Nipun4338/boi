<?php
session_start();
include('database/dbconfig.php');
//fetch_comment.php
$book="zcomments_";
$book.=strval($_POST["book_id"]);

$sql = "
SELECT * FROM $book
WHERE parent_comment_id = '0'
ORDER BY comment_id DESC
";

$result=mysqli_query($link,$sql) or die(mysqli_error($link));
$data=array();
$noOfRows=mysqli_num_rows($result);
if($noOfRows){
  while($row=mysqli_fetch_assoc($result)){

      /*echo "<pre>";
      print_r($row);*/
      array_push($data,$row);
      //echo "</pre>";

  }
}
$output = '';
foreach($data as $row)
{
 $output .= '
 <div class="card " style="margin: 10px;font-family:Helvetica">
  <div class="card-header">By <b>'.$row["sender_name"].'</b> on <i>'.date('M j, Y g:i A', strtotime($row["date"])).'</i></div>
  <div class="card-body">'.$row["comment"].'</div>
  <div class="card-footer text-muted" align="right"><button type="button" class="btn btn-primary reply btn-sm" id="'.$row["comment_id"].'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($connection, $row["comment_id"]);
}

echo json_encode($output);

function get_reply_comment($connection, $parent_id = 0, $marginleft = 0)
{
  $book="zcomments_";
  $book.=strval($_POST["book_id"]);
 $sql = "
 SELECT * FROM $book WHERE parent_comment_id = '$parent_id'
 ";
 $output = '';
 $result1=mysqli_query($connection,$sql) or die(mysqli_error($connection));
 $data1=array();
 $noOfRows1=mysqli_num_rows($result1);
 if($noOfRows1){
   while($row=mysqli_fetch_assoc($result1)){

       /*echo "<pre>";
       print_r($row);*/
       array_push($data1,$row);
       //echo "</pre>";

   }
 }

 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($noOfRows1 > 0)
 {
  foreach($data1 as $row)
  {
   $output .= '
   <div class="card" style="margin-left:'.$marginleft.'px;margin-top: 10px;margin-bottom: 10px;font-family:Helvetica">
    <div class="card-header">By <b>'.$row["sender_name"].'</b> on <i>'.date('M j, Y g:i A', strtotime($row["date"])).'</i></div>
    <div class="card-body">'.$row["comment"].'</div>
    <div class="card-footer text-muted" align="right"><button type="button" class="btn btn-primary reply btn-sm" id="'.$row["comment_id"].'">Reply</button></div>
   </div>
   ';

   $output .= get_reply_comment($connection, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}

?>
