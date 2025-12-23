<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Administrator Profile</h6>
            <a href="register.php" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <div class="card-body">
            <?php 
            if (isset($_POST["edit_btn"]) && isset($_POST["edit_id"])) {
                $id = $_POST["edit_id"];
                
                // Fetch admin details using prepared statement
                $stmt = mysqli_prepare($connection, "SELECT * FROM adminpanel WHERE admin_id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) { ?>
                    <form action="scripts.php" method="POST" class="needs-validation">
                        <input type="hidden" name="edit_id" value="<?php echo $row["admin_id"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Full Name / Username</label>
                                <input type="text" name="edit_username" value="<?php echo htmlspecialchars($row["username"]); ?>" class="form-control" placeholder="Enter Username" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Email Address</label>
                                <input type="email" name="edit_email" value="<?php echo htmlspecialchars($row["email"]); ?>" class="form-control" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">New Password</label>
                                <input type="password" name="edit_password" class="form-control" placeholder="Leave blank to keep current password">
                                <small class="text-muted">Only fill this if you want to change the password.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Account Status</label>
                                <select name="edit_status" class="form-control" required>
                                    <option value="1" <?php echo ($row["status"] == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($row["status"] == 0) ? 'selected' : ''; ?>>Disabled</option>
                                </select>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-3">
                            <button type="submit" name="updatebtn" class="btn btn-primary px-5 shadow-sm">
                                <i class="fas fa-save mr-2"></i> Update Profile
                            </button>
                            <a href="register.php" class="btn btn-outline-danger ml-2 px-4">Cancel</a>
                        </div>
                    </form>
                <?php }
                else {
                    echo '<div class="alert alert-warning">Administrator record not found.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Invalid request parameter.</div>';
            } ?>
        </div>
    </div>
</div>

<?php
include "scripts.php";
include "includes/footer.php";
?>
