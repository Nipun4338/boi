<?php
include "security.php";
include "includes/header.php";
include "includes/navbar.php";
include "../includes/config/dbconfig.php";

if (isset($_POST["delete"]) && isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];
    $stmt = mysqli_prepare($connection, "DELETE FROM user WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "User has been deleted successfully.";
    } else {
        $_SESSION["status"] = "Error deleting user: " . mysqli_error($connection);
    }
}
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">User Management</h6>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM user ORDER BY created_date DESC";
                        $query_run = mysqli_query($connection, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["user_id"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                    <td class="text-center">
                                        <img src="<?php echo (strpos($row["image"], 'http') === 0) ? htmlspecialchars($row["image"]) : '../' . htmlspecialchars($row["image"]); ?>" class="rounded-circle" height="40px" width="40px" onerror="this.src='../assets/images/user.png'">
                                    </td>
                                    <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                                    <td>
                                        <?php if ($row["status"] == 1): ?>
                                            <span class="badge badge-success">Active</span>
                                        <?php elseif ($row["status"] == 2): ?>
                                            <span class="badge badge-warning">Unverified</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Suspended</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><small><?php echo date("M j, Y", strtotime($row["created_date"])); ?></small></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <form action="user_edit.php" method="post" class="mr-1">
                                                <input type="hidden" name="edit_id_user" value="<?php echo $row["user_id"]; ?>">
                                                <button type="submit" name="edit_btn_user" class="btn btn-sm btn-info" title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action="userinfo.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <input type="hidden" name="user_id" value="<?php echo $row["user_id"]; ?>">
                                                <button type="submit" name="delete" class="btn btn-sm btn-danger" title="Delete User">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No Users Found</td></tr>";
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
