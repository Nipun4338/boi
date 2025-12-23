<?php
session_start();
include "includes/config/dbconfig.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Sell | বই</title>
    
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
        .instruction-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: #fff;
        }
        .step-number {
            width: 40px;
            height: 40px;
            background: #0d6efd;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .instruction-step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="instruction-card p-4 p-md-5">
                    <h2 class="fw-bold text-center mb-5">How to Sell Your Books</h2>
                    
                    <div class="instruction-step">
                        <div class="step-number">1</div>
                        <div>
                            <h5 class="fw-bold mb-1">Create an Account</h5>
                            <p class="text-muted">First, <a href="subscribe" class="text-decoration-none">sign up</a> or log in to your Boi account to start selling.</p>
                        </div>
                    </div>

                    <div class="instruction-step">
                        <div class="step-number">2</div>
                        <div>
                            <h5 class="fw-bold mb-1">Go to Sell Page</h5>
                            <p class="text-muted">Click on the <a href="sell" class="text-decoration-none">SELL</a> button in the navigation menu.</p>
                        </div>
                    </div>

                    <div class="instruction-step">
                        <div class="step-number">3</div>
                        <div>
                            <h5 class="fw-bold mb-1">Fill in Book Details</h5>
                            <p class="text-muted">Provide accurate information about the book, including title, author, category, price, and current condition.</p>
                        </div>
                    </div>

                    <div class="instruction-step">
                        <div class="step-number">4</div>
                        <div>
                            <h5 class="fw-bold mb-1">Upload Photos</h5>
                            <p class="text-muted">Upload clear images of the book. You can add multiple photos to show its condition. The first image will be your cover.</p>
                        </div>
                    </div>

                    <div class="instruction-step">
                        <div class="step-number">5</div>
                        <div>
                            <h5 class="fw-bold mb-1">Submit & Wait for Review</h5>
                            <p class="text-muted">After submission, our team will review your ad. Once approved, it will be visible to all buyers.</p>
                        </div>
                    </div>

                    <div class="alert alert-warning rounded-3 mt-4 border-0">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle mt-1 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Important Note</h6>
                                <p class="small mb-0">Incorrect or inappropriate ads will not be published. Users posting misleading content may be permanently banned.</p>
                            </div>
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
