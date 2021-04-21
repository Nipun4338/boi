<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
if(isset($_REQUEST['delete']))
{
  $id=$_POST["slider_id"];
  $sql="DELETE from slider2 where slider_id='$id'";
  $result2=mysqli_query($link,$sql) or die(mysqli_error($link));
  if($result2)
  {
    $_SESSION['success']="Slider is deleted!";
  }
}
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Slider 2 Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="scripts.php" enctype="multipart/form-data" method="POST">

        <div class="modal-body">

            <div class="form-group mb-3">
              <label>Upload Slide Picture</label>
              <input type="file" name="file_upload" class="form-control"/>
            </div>

            <div class="form-group">
                <label>Status</label>
                <input type="number" name="status" class="form-control" required>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtnslider2" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Slider 2 Details
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Slider
            </button>
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
      $query = "SELECT * FROM slider2";
      $query_run = mysqli_query($connection, $query);
  ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th>Image</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
          <?php

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                            <tr>
                                <td><?php  echo $row['slider_id']; ?></td>
                                <td><img src="../<?php echo $row['image']; ?>" height="50px" width="50px"/></td>
                                <td><?php  echo $row['status']; ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["created_date"]));  ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["updated_date"]));  ?></td>
                                <td>
                                    <form action="slider2_edit.php" method="post">
                                        <input type="hidden" name="edit_id_slider2" value="<?php echo $row['slider_id']; ?>">
                                        <button type="submit" name="edit_btn_slider2" class="btn btn-success"> EDIT</button>
                                    </form>
                                </td>
                                <td>
                                  <form class="form-container" action="slider2.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="slider_id" value="<?php echo $row["slider_id"] ?>">
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
