<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Support Inquiries (Contact Us)</h6>
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
                            <th>Inquiry ID</th>
                            <th>Sender Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Inquiry Message</th>
                            <th>Received On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM contact ORDER BY date DESC";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                    <td><strong class="text-dark"><?php echo htmlspecialchars($row["name"]); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                                    <td style="max-width: 400px;"><div class="text-truncate" title="<?php echo htmlspecialchars($row["message"]); ?>"><?php echo htmlspecialchars($row["message"]); ?></div></td>
                                    <td><small class="text-muted"><?php echo date("M j, Y g:i A", strtotime($row["date"])); ?></small></td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4'>No inquiries found.</td></tr>";
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
