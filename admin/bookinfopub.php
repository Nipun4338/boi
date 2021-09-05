<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');


if(isset($_REQUEST['delete']))
{
  $book=$_POST["book_id"];
  $user=$_POST["user_id"];
  $sql="DELETE from books where book_id='$book' and owner_id='$user'";
  $result=mysqli_query($link,$sql) or die(mysqli_error($link));
  if($result)
  {
    $_SESSION['success']="Book is deleted!";
  }
}

?>




<div class="container-fluid" style="text-align:center">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Book Details
    </h6>
  </div>

  <div class="card-body">
    <?php
    if(isset($_SESSION['success']) && $_SESSION['success']!='')
    {
      echo '<h2>'.$_SESSION['success'].'</h2>';
      unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status']!='')
    {
      echo '<h2 class="bg-info">'.$_SESSION['status'].'</h2>';
      unset($_SESSION['status']);
    }
     ?>

    <div class="table-responsive">
      <?php
      $query = "SELECT * FROM books where status='1' order by created_date desc";
      $query_run1 = mysqli_query($connection, $query);
  ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Book Name </th>
            <th> Image </th>
            <th>Author</th>
            <th>Owner Id</th>
            <th>Price</th>
            <th>Category</th>
            <th>Details</th>
            <th>Location</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
          <?php

                        if(mysqli_num_rows($query_run1) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run1))
                            {
                        ?>
                            <tr>
                                <td><?php  echo $row['book_id']; ?></td>
                                <td><?php  echo $row['name']; ?></td>
                                <td><img src="<?php echo $row['image']; ?>" height="50px" width="50px"/></td>
                                <td><?php  echo $row['author']; ?></td>
                                <td><?php  echo $row['owner_id']; ?></td>
                                <td><?php  echo $row['price']; ?></td>
                                <td><?php  echo $row['category']; ?></td>
                                <td><?php  echo $row['present_condition']; ?></td>
                                <td><?php  echo $row['location']; ?></td>
                                <td><?php  echo $row['status']; ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["created_date"]));  ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["updated_date"]));  ?></td>
                                <td>
                                    <form action="book_edit.php" method="post">
                                        <input type="hidden" name="edit_id_book" value="<?php echo $row['book_id']; ?>">
                                        <button type="submit" name="edit_btn_book" class="btn btn-success"> EDIT</button>

                                    </form>
                                  </td>
                                  <td>
                                    <form class="form-container" action="bookinfopub.php" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="book_id" value="<?php echo $row["book_id"] ?>">
                                      <input type="hidden" name="user_id" value="<?php echo $row["owner_id"] ?>">
                       							 <button type="submit" id="submit" name="delete"  class="btn btn-danger btn-block submit2">DELETE</button>
                                  </form>
                                </td>
                            </tr>
                        <?php
                            }
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
          <!--<tr>
            <td> 1 </td>
            <td> Funda of WEb IT</td>
            <td> funda@example.com</td>
            <td> *** </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>-->

        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('scripts.php');
include('includes/footer.php');
?>
