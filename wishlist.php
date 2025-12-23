<?php
include "includes/auth/security.php";
include "includes/config/dbconfig.php";

$user_id = $_SESSION["user_id"];

// Add to wishlist logic
if (isset($_GET["book"])) {
    $book_id = $_GET["book"];
    date_default_timezone_set("Asia/Dhaka");
    $datetime = date("Y-m-d H:i:s");

    $stmt_check = mysqli_prepare($connection, "SELECT wishlist_id FROM wishlist WHERE book_id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt_check, "ii", $book_id, $user_id);
    mysqli_stmt_execute($stmt_check);
    $res_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($res_check) == 0) {
        $stmt_ins = mysqli_prepare($connection, "INSERT INTO wishlist (book_id, user_id, status, created_date, updated_date) VALUES (?, ?, '1', ?, ?)");
        mysqli_stmt_bind_param($stmt_ins, "iiss", $book_id, $user_id, $datetime, $datetime);
        mysqli_stmt_execute($stmt_ins);
        $_SESSION['wishlist_msg'] = "Book added to wishlist.";
    } else {
        $_SESSION['wishlist_msg'] = "Book is already in your wishlist.";
    }
}

// Delete from wishlist logic
if (isset($_POST["delete"]) && isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];
    $stmt_del = mysqli_prepare($connection, "DELETE FROM wishlist WHERE book_id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt_del, "ii", $book_id, $user_id);
    mysqli_stmt_execute($stmt_del);
    $_SESSION['wishlist_msg'] = "Book removed from wishlist.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .wishlist-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .table img {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="home" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">Wishlist</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold m-0"><i class="fas fa-heart text-danger me-2"></i>My Wishlist</h2>
                </div>

                <?php if (isset($_SESSION['wishlist_msg'])): ?>
                    <div class="alert alert-info alert-dismissible fade show rounded-3 mb-4" role="alert">
                        <?php echo htmlspecialchars($_SESSION['wishlist_msg']); unset($_SESSION['wishlist_msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card wishlist-card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Book Details</th>
                                        <th>Price</th>
                                        <th>Added On</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt_list = mysqli_prepare($connection, "SELECT w.book_id, b.name, b.author, b.price, w.created_date FROM wishlist w JOIN books b ON b.book_id = w.book_id WHERE w.user_id = ? ORDER BY w.created_date DESC");
                                    mysqli_stmt_bind_param($stmt_list, "i", $user_id);
                                    mysqli_stmt_execute($stmt_list);
                                    $res_list = mysqli_stmt_get_result($stmt_list);

                                    if (mysqli_num_rows($res_list) > 0) {
                                        while ($row = mysqli_fetch_assoc($res_list)) {
                                            ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <a href="book?book=<?php echo $row['book_id']; ?>" class="h6 fw-bold text-dark text-decoration-none d-block mb-1">
                                                                <?php echo htmlspecialchars($row['name']); ?>
                                                            </a>
                                                            <small class="text-muted">by <?php echo htmlspecialchars($row['author']); ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="fw-bold text-primary">৳<?php echo htmlspecialchars($row['price']); ?></span></td>
                                                <td><small class="text-muted"><?php echo date("M j, Y", strtotime($row['created_date'])); ?></small></td>
                                                <td class="text-center pe-4">
                                                    <form action="wishlist" method="POST" onsubmit="return confirm('Remove this book from wishlist?');">
                                                        <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                                                        <button type="submit" name="delete" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                            <i class="fas fa-trash-alt me-1"></i> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="4" class="text-center py-5"><p class="text-muted mb-0">Your wishlist is empty.</p></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="progress-bar fixed-bottom" id="myBar" style="height:4px; background: #0d6efd; width: 0%;"></div>
    <?php include "includes/components/footer.php"; ?>

    <script>
        window.onscroll = function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("myBar").style.width = scrolled + "%";
        };
    </script>
</body>
</html>
