<?php
include "includes/auth/security.php";
include "includes/config/dbconfig.php";

date_default_timezone_set("Asia/Dhaka");
$datetime = date("Y-m-d H:i:s");
$email = $_SESSION["username"];
$user_id = $_SESSION["user_id"];

// Update active status
$stmt_active = mysqli_prepare($connection, "UPDATE user SET active_status='Online', active_status_date=? WHERE user_id=?");
mysqli_stmt_bind_param($stmt_active, "si", $datetime, $user_id);
mysqli_stmt_execute($stmt_active);

// Fetch user data
$stmt_user = mysqli_prepare($link, "SELECT * FROM user WHERE email=? AND status=1");
mysqli_stmt_bind_param($stmt_user, "s", $email);
mysqli_stmt_execute($stmt_user);
$result_user = mysqli_stmt_get_result($stmt_user);
$user_data = mysqli_fetch_assoc($result_user);

if (!$user_data) {
    header("Location: logout");
    exit();
}

// Fetch user's books
$stmt_books = mysqli_prepare($connection, "SELECT * FROM books WHERE owner_id=? ORDER BY created_date DESC");
mysqli_stmt_bind_param($stmt_books, "i", $user_id);
mysqli_stmt_execute($stmt_books);
$query_run1 = mysqli_stmt_get_result($stmt_books);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
        }
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 120px;
        }
        .profile-img-container {
            margin-top: -60px;
            text-align: center;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 5px solid #fff;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .table-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .btn-action {
            width: 40px;
            height: 40px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card profile-card shadow-sm">
                    <div class="profile-header"></div>
                    <div class="card-body p-4 pt-0">
                        <div class="profile-img-container mb-3">
                            <img src="<?php echo htmlspecialchars($user_data["image"] ?: 'assets/images/default-user.png'); ?>" class="profile-img" alt="Profile Image">
                        </div>
                        <div class="text-center">
                            <h2 class="fw-bold mb-1"><?php echo htmlspecialchars($user_data["name"]); ?></h2>
                            <p class="text-muted mb-3"><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($user_data["email"]); ?></p>
                            
                            <div class="row g-3 justify-content-center">
                                <div class="col-auto">
                                    <div class="bg-light p-2 px-3 rounded-pill">
                                        <small class="text-muted d-block">Phone</small>
                                        <span class="fw-bold"><?php echo htmlspecialchars($user_data["phone"] ?: 'Not Set'); ?></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-light p-2 px-3 rounded-pill">
                                        <small class="text-muted d-block">Address</small>
                                        <span class="fw-bold"><?php echo htmlspecialchars(($user_data["address"] ?? $user_data["address?"]) ?: 'Not Set'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-dark">My Listings</h4>
                        <a href="sell" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Add New Book
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <?php if (isset($_SESSION["success"])): ?>
                            <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($_SESSION["success"]); unset($_SESSION["success"]); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th class="ps-4">Book Details</th>
                                        <th>Price</th>
                                        <th>Location</th>
                                        <th>Posted On</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($query_run1) > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($query_run1)): ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-0">
                                                            <div class="fw-bold text-dark">
                                                                <a href="book?book=<?php echo urlencode($row["book_id"]); ?>" class="text-decoration-none text-dark">
                                                                    <?php echo htmlspecialchars($row["name"]); ?>
                                                                </a>
                                                            </div>
                                                            <div class="small text-muted"><?php echo htmlspecialchars($row["author"]); ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="fw-bold text-success">TK. <?php echo htmlspecialchars($row["price"]); ?></span></td>
                                                <td><?php echo htmlspecialchars($row["location"]); ?></td>
                                                <td><small class="text-muted"><?php echo date("M j, Y", strtotime($row["created_date"])); ?></small></td>
                                                <td>
                                                    <?php if($row['status'] == 1): ?>
                                                        <span class="badge bg-success-soft text-success px-3 rounded-pill">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning-soft text-warning px-3 rounded-pill">Pending</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <form action="book_edit" method="post" class="d-inline">
                                                            <input type="hidden" name="edit_id_book" value="<?php echo $row["book_id"]; ?>">
                                                            <button type="submit" name="edit_btn_book" class="btn btn-outline-success btn-action" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </form>
                                                        <form action="actions/books/process_book.php" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                                            <input type="hidden" name="delete_book" value="<?php echo $row["book_id"]; ?>">
                                                            <button type="submit" name="delete_btn" class="btn btn-outline-danger btn-action" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <img src="assets/icons/empty-books.svg" alt="No Books" style="width: 100px; opacity: 0.3" class="mb-3">
                                                <p class="text-muted px-4">You haven't posted any books yet.</p>
                                                <a href="sell" class="btn btn-primary px-4 rounded-pill">Post Your First Book</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white py-3 text-center text-muted small">
                        * Deleting a listing is permanent and cannot be undone.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="progress-container fixed-bottom">
        <div class="progress-bar" id="myBar"></div>
    </div>
    <?php include "includes/components/footer.php"; ?>

</body>
</html>
