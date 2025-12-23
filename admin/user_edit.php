<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit User Account</h6>
            <a href="userinfo.php" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <div class="card-body">
            <?php 
            if (isset($_POST["edit_btn_user"]) && isset($_POST["edit_id_user"])) {
                $id = $_POST["edit_id_user"];
                
                // Fetch user details using prepared statement
                $stmt = mysqli_prepare($connection, "SELECT * FROM user WHERE user_id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) { ?>
                    <form action="scripts.php" method="POST">
                        <input type="hidden" name="edit_id_user" value="<?php echo $row["user_id"]; ?>">
                        
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <label class="d-block fw-bold text-muted mb-3">Profile Picture</label>
                                <img src="<?php echo !empty($row["image"]) ? htmlspecialchars($row["image"]) : '../assets/images/icons/user.png'; ?>" 
                                     class="img-profile rounded-circle shadow-sm" 
                                     style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #f8f9fc;"
                                     onerror="this.src='../assets/images/icons/user.png'">
                            </div>
                            
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label font-weight-bold">Full Name</label>
                                        <input type="text" value="<?php echo htmlspecialchars($row["name"]); ?>" class="form-control" readonly disabled bg-light>
                                        <small class="text-muted">Usernames can only be changed by the user themselves.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Email Address</label>
                                        <input type="email" value="<?php echo htmlspecialchars($row["email"]); ?>" class="form-control" readonly disabled bg-light>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Phone Number</label>
                                        <input type="text" value="<?php echo htmlspecialchars($row["phone"]); ?>" class="form-control" readonly disabled bg-light>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Account Status</label>
                                        <select name="edit_status" class="form-control border-left-primary" required>
                                            <option value="1" <?php echo ($row["status"] == 1) ? 'selected' : ''; ?>>Active</option>
                                            <option value="0" <?php echo ($row["status"] == 0) ? 'selected' : ''; ?>>Unverified / Inactive</option>
                                            <option value="3" <?php echo ($row["status"] == 3) ? 'selected' : ''; ?>>Suspended / Banned</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Member Since</label>
                                        <input type="text" value="<?php echo date("M j, Y", strtotime($row["created_date"])); ?>" class="form-control" readonly disabled bg-light>
                                    </div>
                                </div>

                                <div class="border-top pt-4 mt-3">
                                    <button type="submit" name="updatebtnuser" class="btn btn-primary px-5 shadow-sm">
                                        <i class="fas fa-save mr-2"></i> Update User Status
                                    </button>
                                    <a href="userinfo.php" class="btn btn-outline-danger ml-2 px-4">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }
                else {
                    echo '<div class="alert alert-warning">User record not found.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Invalid user selection.</div>';
            } ?>
        </div>
    </div>
</div>

<?php
include "scripts.php";
include "includes/footer.php";
?>
