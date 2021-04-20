<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
?>



<div class="container-fluid" style="text-align:center">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Contact Us Details
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
      $query = "SELECT * FROM contact order by date desc";
      $query_run = mysqli_query($connection, $query);
  ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr >
            <th> ID </th>
            <th> Name </th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Date</th>
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
                                <td><?php  echo $row['id']; ?></td>
                                <td><?php  echo $row['name']; ?></td>
                                <td><?php  echo $row['email']; ?></td>
                                <td><?php  echo $row['phone']; ?></td>
                                <td><?php  echo $row['message']; ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($row["date"]));  ?></td>
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
