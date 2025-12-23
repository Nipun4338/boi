<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Book Details</h6>
            <a href="bookinfo.php" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <div class="card-body">
            <?php 
            if (isset($_POST["edit_btn_book"]) && isset($_POST["edit_id_book"])) {
                $book_id = $_POST["edit_id_book"];
                
                // Fetch book details using prepared statement
                $stmt = mysqli_prepare($connection, "SELECT * FROM books WHERE book_id = ?");
                mysqli_stmt_bind_param($stmt, "i", $book_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) {
                    // Fetch owner details
                    $owner_stmt = mysqli_prepare($connection, "SELECT name, email FROM user WHERE user_id = ?");
                    mysqli_stmt_bind_param($owner_stmt, "i", $row["owner_id"]);
                    mysqli_stmt_execute($owner_stmt);
                    $owner_result = mysqli_stmt_get_result($owner_stmt);
                    $owner = mysqli_fetch_assoc($owner_result);
                    ?>
                    
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <label class="d-block fw-bold text-muted mb-3">Current Cover</label>
                            <img src="../<?php echo htmlspecialchars($row["image"]); ?>" class="img-fluid rounded shadow-sm" style="max-height: 400px; border: 1px solid #eee;">
                        </div>
                        
                        <div class="col-md-8">
                            <form action="scripts.php" method="POST">
                                <input type="hidden" name="edit_id_book" value="<?php echo $row["book_id"]; ?>">
                                <input type="hidden" name="mail" value="<?php echo htmlspecialchars($owner["email"]); ?>">
                                <input type="hidden" name="mail_name" value="<?php echo htmlspecialchars($owner["name"]); ?>">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Book Title</label>
                                        <input type="text" name="edit_car_name" value="<?php echo htmlspecialchars($row["name"]); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Author</label>
                                        <input type="text" name="edit_brand" value="<?php echo htmlspecialchars($row["author"]); ?>" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Price (৳)</label>
                                        <input type="text" name="edit_price" value="<?php echo htmlspecialchars($row["price"]); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Status</label>
                                        <select name="edit_status" class="form-control border-left-info" required>
                                            <option value="1" <?php echo ($row["status"] == 1) ? 'selected' : ''; ?>>Published / Active</option>
                                            <option value="2" <?php echo ($row["status"] == 2) ? 'selected' : ''; ?>>Pending Approval</option>
                                            <option value="0" <?php echo ($row["status"] == 0) ? 'selected' : ''; ?>>Rejected / Inactive</option>
                                        </select>
                                        <small class="text-info mt-1 d-block"><i class="fas fa-info-circle"></i> Status 1 is visible to users.</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Seller Information</label>
                                    <div class="p-3 bg-light rounded border">
                                        <p class="mb-1"><strong>Name:</strong> <?php echo htmlspecialchars($owner["name"] ?? 'Unknown / Deleted User'); ?></p>
                                        <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($owner["email"] ?? 'N/A'); ?></p>
                                        <p class="mb-0"><strong>Location:</strong> <?php echo htmlspecialchars($row["location"] ?? 'N/A'); ?></p>
                                        <input type="hidden" name="edit_car_model" value="<?php echo htmlspecialchars($row["owner_id"]); ?>">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label font-weight-bold">Present Condition / Details</label>
                                    <textarea name="edit_details" rows="5" class="form-control" required><?php echo htmlspecialchars($row["present_condition"]); ?></textarea>
                                </div>

                                <div class="border-top pt-4">
                                    <button type="submit" name="updatebtnbook" class="btn btn-primary px-5 shadow-sm">
                                        <i class="fas fa-save mr-2"></i> Update Book Data
                                    </button>
                                    <a href="bookinfo.php" class="btn btn-outline-danger ml-2 px-4">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '<div class="alert alert-warning">Book not found or invalid ID.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Invalid access request.</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php
include "scripts.php";
include "includes/footer.php";
?>
