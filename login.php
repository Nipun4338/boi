<?php 
session_start();
include "includes/config/dbconfig.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f4f7f6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            max-width: 1000px;
            width: 100%;
        }
        .login-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        .login-form-side {
            padding: 3rem;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
            border-color: #667eea;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: bold;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .mySlides {
            display: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            max-height: 400px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php 
    include "includes/components/nav.php"; 
    ?>

    <div class="login-container container">
        <div class="login-card row g-0">
            <div class="col-lg-5 login-image d-none d-lg-flex">
                <h2 class="fw-bold mb-4">Welcome Back!</h2>
                <p class="mb-5">Log in to manage your listings, messages, and wishlist.</p>
                
                <?php
                $stmt = mysqli_prepare($link, "SELECT image FROM slider1");
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $slider_data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $slider_data[] = $row;
                }
                shuffle($slider_data);
                ?>
                
                <div class="position-relative" style="height: 300px;">
                    <?php foreach ($slider_data as $row): ?>
                        <img src="<?php echo htmlspecialchars($row["image"]); ?>" class="img-fluid mySlides w-100 h-100" alt="Slider Image">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-7 login-form-side bg-white">
                <div class="mb-5 text-center text-lg-start">
                    <h2 class="fw-bold text-dark mb-2">Login</h2>
                    <p class="text-muted">Enter your credentials to access your account</p>
                </div>

                <?php if (isset($_SESSION["status"]) && $_SESSION["status"] != ""): ?>
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo htmlspecialchars($_SESSION["status"]); unset($_SESSION["status"]); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="code.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control border-start-0" placeholder="name@example.com" required>
                        </div>
                    </div>
                    
                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" name="login" class="btn btn-primary btn-login text-white py-3">
                            Sign In
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted mb-0">Don't have an account? 
                            <a href="subscribe" class="text-primary fw-bold text-decoration-none">Create One</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (x.length === 0) return;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) { myIndex = 1 }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 5000);
        }

        // Bootstrap validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <?php include "includes/components/footer.php"; ?>
</body>
</html>
