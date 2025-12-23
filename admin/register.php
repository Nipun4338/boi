<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel text-primary fw-bold">Add Administrator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="scripts.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control" placeholder="Repeat Password" required>
                    </div>
                </div>
                <div class="modal-footer pt-0 border-top-0">
                    <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary shadow-sm px-4">Save Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Administrator Profiles</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addadminprofile">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New Admin
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
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Last Update</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM adminpanel ORDER BY created_date DESC";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["admin_id"]); ?></td>
                                    <td><strong class="text-dark"><?php echo htmlspecialchars($row["username"]); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                    <td>
                                        <?php if ($row["status"] == 1): ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Disabled</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><small class="text-muted"><?php echo date("M j, Y", strtotime($row["updated_date"])); ?></small></td>
                                    <td class="text-center">
                                        <form action="admin_edit.php" method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row["admin_id"]; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-sm btn-info shadow-sm" title="Edit Admin">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4'>No administrators found.</td></tr>";
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
