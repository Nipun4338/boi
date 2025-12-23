<?php
if (!isset($_SESSION)) {
    session_start();
}
include "includes/config/dbconfig.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-light">
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5 text-center" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="display-1 fw-bold text-primary mb-3">404</div>
                <h2 class="fw-bold text-dark mb-4">Page Not Found</h2>
                <p class="text-muted mb-5 lead">
                    The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. 
                    It looks like you found a glitch in the matrix...
                </p>
                <a href="home" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                    <i class="fas fa-home me-2"></i> Return Home
                </a>
            </div>
        </div>
    </div>

    <?php include "includes/components/footer.php"; ?>
</body>
</html>
