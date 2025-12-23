<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";

// Handle slider deletion
if (isset($_POST["delete"]) && isset($_POST["slider_id"])) {
    $id = $_POST["slider_id"];
    $stmt = mysqli_prepare($connection, "DELETE FROM slider1 WHERE slider_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "Slider image deleted successfully.";
    } else {
        $_SESSION["status"] = "Failed to delete slider image.";
    }
    // Refresh to update table
    header("Location: slider1.php");
    exit();
}
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Add New Login Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="scripts.php" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Slide Picture</label>
                        <input type="file" name="file_upload" class="form-control" required />
                        <small class="text-muted">Recommended size: 1920x1080px</small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1">Active (Visible)</option>
                            <option value="0">Disabled (Hidden)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="registerbtnslider1" class="btn btn-primary shadow-sm px-4">Save Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Login Page Sliders</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addadminprofile">
                <i class="fas fa-plus fa-sm mr-1"></i> Add Slide
            </button>
        </div>

        <div class="card-body">
            <?php
            if (isset($_SESSION["success"]) && $_SESSION["success"] != "") {
                echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION["success"]) . "</div>";
                unset($_SESSION["success"]);
            }
            if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION["status"]) . "</div>";
                unset($_SESSION["status"]);
            }
            ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Preview</th>
                            <th>Status</th>
                            <th>Managed Dates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM slider1 ORDER BY slider_id DESC";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td class="align-middle"><?php echo $row["slider_id"]; ?></td>
                                    <td class="align-middle">
                                        <img src="../<?php echo htmlspecialchars($row["image"]); ?>" 
                                             class="img-thumbnail" style="height: 60px; width: 100px; object-fit: cover;">
                                    </td>
                                    <td class="align-middle">
                                        <?php if($row["status"] == 1): ?>
                                            <span class="badge badge-success px-3">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary px-3">Hidden</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle px-4">
                                        <div class="small"><strong>Created:</strong> <?php echo date("M j, Y", strtotime($row["created_date"])); ?></div>
                                        <div class="small text-muted"><strong>Updated:</strong> <?php echo date("M j, Y", strtotime($row["updated_date"])); ?></div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-center">
                                            <form action="slider1_edit.php" method="post" class="mr-2">
                                                <input type="hidden" name="edit_id_slider1" value="<?php echo $row["slider_id"]; ?>">
                                                <button type="submit" name="edit_btn_slider1" class="btn btn-sm btn-info shadow-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action="slider1.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                                <input type="hidden" name="slider_id" value="<?php echo $row["slider_id"]; ?>">
                                                <button type="submit" name="delete" class="btn btn-sm btn-danger shadow-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='5' class='py-4'>No slider images found.</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include "scripts.php";
include "includes/footer.php";
?>
