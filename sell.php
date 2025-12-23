<?php
include "includes/auth/security.php";
include "includes/config/dbconfig.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.ico">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js" charset="utf-8"></script>
</head>

<body class="bg-light">
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h1 class="text-center mb-4">Post Your Book</h1>
                        <div class="text-center mb-5">
                            <a href="instructions" class="text-decoration-none">
                                <h5 class="text-primary fw-bold">**New Here? Take a quick look</h5>
                            </a>
                        </div>

                        <form action="actions/books/process_book.php" enctype="multipart/form-data" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Book Name</label>
                                    <input type="text" class="form-control" name="book" placeholder="Enter Book Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Author Name</label>
                                    <input type="text" class="form-control" name="author" placeholder="Enter Author Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Category</label>
                                    <input type="text" class="form-control" name="category" placeholder="Enter Category (e.g. Science, Fiction)" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Price (TK)</label>
                                    <input type="number" class="form-control" name="price" placeholder="Enter Price" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Location</label>
                                    <input type="text" class="form-control" name="location" placeholder="e.g. Dhaka, Chittagong" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold">Details / Condition</label>
                                    <textarea class="form-control" name="details" rows="4" placeholder="Describe the book condition..." required></textarea>
                                </div>
                                <div class="col-12 mb-4 p-3 bg-light border rounded">
                                    <label class="form-label fw-bold d-block mb-3">Upload Book Images</label>
                                    <input type="hidden" name="file" role="uploadcare-uploader" 
                                           data-clearable="true" data-crop="free" 
                                           data-images-only="true" data-multiple="true" />
                                    <p class="small text-muted mt-2 mb-0">*Your first chosen image will be the cover image.</p>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="home" class="btn btn-secondary btn-lg px-4 me-md-2">Cancel</a>
                                <button type="submit" name="registerbtnbook" class="btn btn-primary btn-lg px-5">Post Advertisement</button>
                            </div>
                        </form>
                        
                        <script>
                            UPLOADCARE_LOCALE = "en";
                            UPLOADCARE_LIVE = false;
                            UPLOADCARE_PUBLIC_KEY = '17b0d03f8e05e110e978';
                        </script>
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
