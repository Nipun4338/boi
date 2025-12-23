<?php
include "../includes/config/dbconfig.php";
include "security.php";
include "includes/header.php";
include "includes/navbar.php";

// Helper function to get counts
function getCount($conn, $table, $condition = "") {
    $sql = "SELECT COUNT(*) as total FROM $table $condition";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Administrative Dashboard</h1>
        <div class="text-muted small">Welcome back, Admin</div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Registered Admins Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Administrators</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo getCount($connection, "adminpanel"); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registered Books Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Books</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo getCount($connection, "books"); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registered Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registered Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo getCount($connection, "user"); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Approvals Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Books</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo getCount($connection, "books", "WHERE status = 2"); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Content Row (Quick Actions) -->
    <div class="row mt-4">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="bookinfo.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Review Pending Books
                            <span class="badge badge-warning badge-pill"><?php echo getCount($connection, "books", "WHERE status = 2"); ?></span>
                        </a>
                        <a href="userinfo.php" class="list-group-item list-group-item-action">Manage Users</a>
                        <a href="mail.php" class="list-group-item list-group-item-action">Send Broadcast Announcement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "scripts.php";
include "includes/footer.php";
?>
