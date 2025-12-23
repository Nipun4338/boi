<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Login Slider Details</h6>
            <a href="slider1.php" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <div class="card-body">
            <?php 
            if (isset($_POST["edit_btn_slider1"]) && isset($_POST["edit_id_slider1"])) {
                $id = $_POST["edit_id_slider1"];
                
                // Fetch slider details using prepared statement
                $stmt = mysqli_prepare($connection, "SELECT * FROM slider1 WHERE slider_id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) { ?>
                    <form action="scripts.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id_slider1" value="<?php echo $id; ?>">
                        <input type="hidden" name="edit_image" value="<?php echo htmlspecialchars($row["image"]); ?>">
                        
                        <div class="row">
                            <div class="col-md-5 text-center px-4 mb-4">
                                <label class="d-block font-weight-bold text-muted mb-3">Current Slide Image</label>
                                <img src="../<?php echo htmlspecialchars($row["image"]); ?>" 
                                     class="img-fluid rounded shadow-sm border" 
                                     style="max-height: 250px; object-fit: contain;">
                            </div>
                            
                            <div class="col-md-7">
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold">Replace Slide Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="file_upload" class="custom-file-input" id="slideImage">
                                        <label class="custom-file-label" for="slideImage">Choose new file...</label>
                                    </div>
                                    <small class="text-muted">Leave blank to keep the current image.</small>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-weight-bold">Display Status</label>
                                    <select name="edit_status" class="form-control border-left-primary" required>
                                        <option value="1" <?php echo ($row["status"] == 1) ? 'selected' : ''; ?>>Active (Visible)</option>
                                        <option value="0" <?php echo ($row["status"] == 0) ? 'selected' : ''; ?>>Disabled (Hidden)</option>
                                    </select>
                                </div>

                                <hr>
                                
                                <div class="mt-4">
                                    <button type="submit" name="updatebtnslider1" class="btn btn-primary px-5 shadow-sm">
                                        <i class="fas fa-save mr-2"></i> Update Slider Details
                                    </button>
                                    <a href="slider1.php" class="btn btn-outline-danger ml-2">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }
                else {
                    echo '<div class="alert alert-warning">Slider record not found.</div>';
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
