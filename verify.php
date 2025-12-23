<?php
session_start();
include "includes/config/dbconfig.php";

$verify_status = "pending"; 
$message = "";

if (isset($_GET["email"]) && !empty($_GET["email"]) && isset($_GET["hash"]) && !empty($_GET["hash"])) {
    $email = $_GET["email"];
    $hash = $_GET["hash"];

    // Check if user exists and is unverified (status 2)
    $stmt = mysqli_prepare($connection, "SELECT user_id FROM user WHERE email = ? AND hash = ? AND status = '2'");
    mysqli_stmt_bind_param($stmt, "ss", $email, $hash);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Activate account
        $update_stmt = mysqli_prepare($connection, "UPDATE user SET status = '1' WHERE email = ? AND hash = ?");
        mysqli_stmt_bind_param($update_stmt, "ss", $email, $hash);
        
        if (mysqli_stmt_execute($update_stmt)) {
            $verify_status = "success";
            $message = "Your email has been successfully verified! You can now log in to your account.";
        } else {
            $verify_status = "error";
            $message = "Verification failed due to a server error. Please contact support.";
        }
    } else {
        // Check if already verified
        $stmt_active = mysqli_prepare($connection, "SELECT user_id FROM user WHERE email = ? AND status = '1'");
        mysqli_stmt_bind_param($stmt_active, "s", $email);
        mysqli_stmt_execute($stmt_active);
        $res_active = mysqli_stmt_get_result($stmt_active);

        if (mysqli_num_rows($res_active) > 0) {
            $verify_status = "info";
            $message = "Your account is already verified. You can log in anytime.";
        } else {
            $verify_status = "error";
            $message = "Invalid or expired verification link. Please check your email or sign up again.";
        }
    }
} else {
    $verify_status = "error";
    $message = "Invalid approach. Please use the link provided in your email.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .verify-container {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verify-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
            overflow: hidden;
        }
        .status-icon {
            font-size: 5rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container verify-container">
        <div class="card verify-card p-5">
            <div class="card-body">
                <?php if ($verify_status == "success"): ?>
                    <div class="status-icon text-success"><i class="fas fa-check-circle"></i></div>
                    <h2 class="fw-bold mb-3">Verified!</h2>
                    <p class="text-muted mb-4"><?php echo htmlspecialchars($message); ?></p>
                    <a href="login" class="btn btn-primary btn-lg rounded-pill px-5">Go to Login</a>
                <?php elseif ($verify_status == "info"): ?>
                    <div class="status-icon text-info"><i class="fas fa-info-circle"></i></div>
                    <h2 class="fw-bold mb-3">Already Verified</h2>
                    <p class="text-muted mb-4"><?php echo htmlspecialchars($message); ?></p>
                    <a href="login" class="btn btn-primary btn-lg rounded-pill px-5">Go to Login</a>
                <?php else: ?>
                    <div class="status-icon text-danger"><i class="fas fa-times-circle"></i></div>
                    <h2 class="fw-bold mb-3">Verification Failed</h2>
                    <p class="text-muted mb-4"><?php echo htmlspecialchars($message); ?></p>
                    <a href="subscribe" class="btn btn-outline-primary btn-lg rounded-pill px-5">Try Signing Up Again</a>
                <?php endif; ?>
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
