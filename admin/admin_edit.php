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
      <h6 class="m-0 font-weight-bold text-primary">EDIT Admin Profile
      </h6>
    </div>

    <div class="card-body">
      <?php
      if(isset($_POST['edit_btn']))
      {
        $id=$_POST['edit_id'];
        $query = "SELECT * FROM adminpanel WHERE admin_id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach ($query_run as $row) {
          ?>
            <form action="scripts.php" method="POST">
              <input type="hidden" name="edit_id" value="<?php echo $row['admin_id']?>">
              <div class="form-group">
                  <label> Username </label>
                  <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="edit_password"  class="form-control" placeholder="Enter Password" required>
              </div>
              <div class="form-group">
                  <label>Status</label>
                  <input type="text" name="edit_status" value="<?php echo $row['status'] ?>" class="form-control" placeholder="Enter Status">
              </div>
              <a href="register.php" class="btn btn-danger"> CANCEL </a>
              <button type="submit" name="updatebtn" class="btn btn-primary">UPDATE</button>
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
