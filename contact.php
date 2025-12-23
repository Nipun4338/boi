<?php
session_start();
include "includes/config/dbconfig.php";

if (isset($_POST["submit"])) {
    $datetime = date("Y-m-d H:i:s");
    $message = isset($_POST["message"]) ? $_POST["message"] : "";

    if (!isset($_SESSION["username"])) {
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    } else {
        $email = $_SESSION["username"];
        $stmt_user = mysqli_prepare($connection, "SELECT name, phone FROM user WHERE email = ?");
        mysqli_stmt_bind_param($stmt_user, "s", $email);
        mysqli_stmt_execute($stmt_user);
        $res_user = mysqli_stmt_get_result($stmt_user);
        $user_data = mysqli_fetch_assoc($res_user);
        $name = ($user_data) ? $user_data["name"] : "";
        $phone = ($user_data) ? $user_data["phone"] : "";
    }

    $stmt = mysqli_prepare($connection, "INSERT INTO contact (name, email, phone, message, date) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $message, $datetime);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "Message Sent Successfully!";
    } else {
        $_SESSION["success"] = "Failed to send message.";
    }
    header("Location: contact");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <?php include "includes/components/nav.php"; ?>
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h1 class="text-center mb-4">Contact Us</h1>
                        <p class="text-center text-muted mb-5">Email: boi.yourbook@gmail.com</p>

                        <?php if (isset($_SESSION["success"])): ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($_SESSION["success"]); unset($_SESSION["success"]); ?>
                                <button type="button" class="btn-close" data-bs-toggle="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="contact" method="POST">
                            <?php if (!isset($_SESSION["username"])): ?>
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
                                </div>
                            <?php endif; ?>

                            <div class="mb-4">
                                <label class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Type your message here..." required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" name="submit" id="submit_btn" class="btn btn-primary btn-lg" disabled>Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#message').on('keyup', function() {
            if ($(this).val().trim() !== '') {
                $('#submit_btn').prop('disabled', false);
            } else {
                $('#submit_btn').prop('disabled', true);
            }
        });
    });
    </script>

    <div class="progress-container fixed-bottom">
        <div class="progress-bar" id="myBar"></div>
    </div>
    <?php include "includes/components/footer.php"; ?>
</body>
</html>
