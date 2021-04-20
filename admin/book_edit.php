<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
include('database/dbconfig.php');
?>

  <div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">EDIT Book Data
      </h6>
    </div>

    <div class="card-body">
      <?php
      if(isset($_POST['edit_btn_book']))
      {
        $id=$_POST['edit_id_book'];
        $query = "SELECT * FROM books WHERE book_id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
          ?>
            <form action="scripts.php" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="edit_id_book" value="<?php echo $row['book_id']?>">
              <div class="form-group">
                  <label> Book name </label>
                  <input type="text" name="edit_car_name" value="<?php  echo $row['name']; ?>" class="form-control" required >
              </div>
              <div class="form-group">
                  <label>Author</label>
                  <input type="text" name="edit_brand" value="<?php  echo $row['author']; ?>" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Owner Id</label>
                  <input type="text" name="edit_car_model" value="<?php  echo $row['owner_id']; ?>" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Details</label>
                  <input type="text" name="edit_details" value=<?php  echo $row['present_condition']; ?> class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Status</label>
                  <input type="number" name="edit_status" value=<?php  echo $row['status']; ?> class="form-control" required>
              </div>

              <a href="bookinfo.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="updatebtnbook" class="btn btn-primary">UPDATE</button>
            </form>
            <?php
            }
          }
        ?>
    </div>
  </div>

  </div>

<?php
include('scripts.php');
include('includes/footer.php');
?>
