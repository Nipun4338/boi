<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="modal fade" id="mailadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="exampleModalLabel">Compose Broadcast Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="scripts.php" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> This email will be sent to all active registered users.
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Message Body (HTML enabled)</label>
                        <textarea name="body" class="form-control" rows="8" placeholder="Enter Email Body Content" required></textarea>
                        <small class="text-muted">You can use basic HTML tags for styling.</small>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="sendmail" class="btn btn-primary shadow-sm px-4">
                        <i class="fas fa-paper-plane mr-2"></i> Send to All Users
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Email Broadcast History</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#mailadd">
                <i class="fas fa-plus fa-sm text-white-50"></i> New Broadcast
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
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Mail ID</th>
                            <th>Subject</th>
                            <th>Message Preview</th>
                            <th>Sent On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM mail ORDER BY date DESC";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["mail_id"]); ?></td>
                                    <td><strong class="text-dark"><?php echo htmlspecialchars($row["subject"]); ?></strong></td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 500px;" title="<?php echo htmlspecialchars(strip_tags($row["body"])); ?>">
                                            <?php echo htmlspecialchars(substr(strip_tags($row["body"]), 0, 100)) . '...'; ?>
                                        </div>
                                    </td>
                                    <td><small class="text-muted"><?php echo date("M j, Y g:i A", strtotime($row["date"])); ?></small></td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='4' class='text-center py-4'>No email history found.</td></tr>";
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
