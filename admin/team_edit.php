<?php
include("security.php");
include('includes/header.php');
include('includes/navbar.php');
?>

  <div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">EDIT Member Details
      </h6>
    </div>

    <div class="card-body">
      <?php
      $connection = mysqli_connect("localhost","root","","carhub");
      if(isset($_POST['edit_btn_team']))
      {
        $id=$_POST['edit_id_team'];
        $query = "SELECT * FROM team WHERE team_id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
          ?>
            <form action="scripts.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="edit_id_team" value="<?php echo $id?>">
              <input type="hidden" name="edit_image" value="<?php echo $row['image_path']?>">
              <div class="form-group">
                  <label> Member name </label>
                  <input type="text" name="edit_team_name" value="<?php  echo $row['name']; ?>" class="form-control" required >
              </div>
              <div class="form-group">
                  <label>Aust Id</label>
                  <input type="number" name="edit_aust_id" value="<?php  echo $row['aust_id']; ?>" class="form-control" required>
              </div>
              <div class="form-group mb-3">
                <label>Upload Profile Picture</label>
                <input type="file" name="file_upload" class="form-control"/>
              </div>

              <div class="form-group">
                  <label>Status</label>
                  <input type="number" name="edit_status" value=<?php  echo $row['status']; ?> class="form-control" required>
              </div>

              <a href="registerteam.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="updatebtnteam" class="btn btn-primary">UPDATE</button>
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
