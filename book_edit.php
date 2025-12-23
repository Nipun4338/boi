<?php
include "includes/auth/security.php";
include "includes/config/dbconfig.php";

if (!isset($_POST["edit_btn_book"])) {
    header("Location: profile");
    exit();
}

$book_id = $_POST["edit_id_book"];
$user_id = $_SESSION["user_id"];

// Fetch book details and verify ownership
$stmt = mysqli_prepare($connection, "SELECT * FROM books WHERE book_id = ? AND owner_id = ?");
mysqli_stmt_bind_param($stmt, "ii", $book_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$row = mysqli_fetch_assoc($result)) {
    $_SESSION['error'] = "You do not have permission to edit this book.";
    header("Location: profile");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book | বই</title>
    
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
        .edit-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .form-label { font-weight: 600; color: #495057; }
        .book-preview {
            max-width: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="home" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="profile" class="text-decoration-none">Profile</a></li>
                <li class="breadcrumb-item active">Edit Book</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card edit-card">
                    <div class="card-header bg-white py-3 border-0">
                        <h4 class="fw-bold text-primary mb-0"><i class="fas fa-edit me-2"></i>Edit Book Details</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-4 p-3 bg-light rounded-3">
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" class="book-preview me-3" alt="">
                            <div>
                                <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="text-muted mb-0">by <?php echo htmlspecialchars($row['author']); ?></p>
                                <span class="badge bg-secondary mt-2"><?php echo htmlspecialchars($row['category']); ?></span>
                            </div>
                        </div>

                        <form action="actions/books/process_book.php" method="POST">
                            <input type="hidden" name="edit_id_book" value="<?php echo $book_id; ?>">
                            
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price (TK)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input type="number" name="edit_price" value="<?php echo htmlspecialchars($row['price']); ?>" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label class="form-label">Book Condition / Details</label>
                                    <textarea name="edit_details" class="form-control" rows="5" placeholder="Describe the current condition of the book..." required><?php echo htmlspecialchars($row['present_condition']); ?></textarea>
                                    <div class="form-text">Mention any damage, missing pages, or special notes.</div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="profile" class="btn btn-light px-4">Cancel</a>
                                <button type="submit" name="updatebtnbook" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </form>
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
