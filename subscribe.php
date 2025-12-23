<?php 
session_start();
include "includes/config/dbconfig.php";

include "includes/config/mail_config.php";

$success_message = "";
$error_message = "";
date_default_timezone_set("Asia/Dhaka");

if (isset($_POST["submit"])) {
    $datetime = date("Y-m-d H:i:s");
    $user_email = trim($_POST["email"]);
    $user_name = trim($_POST["name"]);
    $user_phone = trim($_POST["phone"]);
    $user_address = trim($_POST["address"]);
    $user_password = md5($_POST["password"]);

    // Check for existing user
    $stmt_check = mysqli_prepare($connection, "SELECT status FROM user WHERE email = ?");
    mysqli_stmt_bind_param($stmt_check, "s", $user_email);
    mysqli_stmt_execute($stmt_check);
    $res_check = mysqli_stmt_get_result($stmt_check);

    if ($row = mysqli_fetch_assoc($res_check)) {
        if ($row["status"] == 2) {
            $error_message = "This email is already registered but not verified. Please check your inbox.";
        } else {
            $error_message = "This email is already registered. Please log in.";
        }
    } else {
        $target_dir = !empty($_POST["file"]) ? $_POST["file"] : "https://ucarecdn.com/4d13fbd1-4dbf-4fc3-8a56-3cbb8fba76e4/";
        $hash1 = md5(rand(0, 1000) . time());
        $baseUrl = getBaseUrl();

        $stmt_insert = mysqli_prepare($connection, "INSERT INTO user(name, email, phone, address, password, image, status, created_date, updated_date, hash) VALUES (?, ?, ?, ?, ?, ?, 2, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt_insert, "sssssssss", $user_name, $user_email, $user_phone, $user_address, $user_password, $target_dir, $datetime, $datetime, $hash1);
        
        if (mysqli_stmt_execute($stmt_insert)) {
            try {
                $mail = getPHPMailer("Boi YourBook");
                $mail->addAddress($user_email, $user_name);
                $mail->isHTML(true);
                $mail->Subject = "Verify Your Account | Boi";
                
                $verification_link = $baseUrl . "verify?email=" . urlencode($user_email) . "&hash=" . urlencode($hash1);
                
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; padding: 30px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; margin: auto;'>
                        <h2 style='color: #667eea;'>Welcome to Boi, " . htmlspecialchars($user_name) . "!</h2>
                        <p style='font-size: 16px; line-height: 1.6;'>Thank you for joining our community of book lovers. Please verify your email address to get started.</p>
                        <div style='text-align: center; margin: 30px 0;'>
                            <a href='$verification_link' 
                               style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; text-decoration: none; border-radius: 10px; font-weight: bold; display: inline-block;'>
                               Verify My Account
                            </a>
                        </div>
                        <p style='font-size: 14px; color: #666; word-break: break-all;'>
                            If the button doesn't work, copy and paste this link: $verification_link
                        </p>
                        <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
                        <p style='font-size: 11px; color: #999;'>This is an automated message. Please do not reply directly to this email.</p>
                    </div>";

                $mail->send();
                $success_message = "Verification Email sent to " . htmlspecialchars($user_email) . ". Please check your inbox (and spam) to activate your account.";
            } catch (Exception $e) {
                $error_message = "User registered, but verification email failed to send: " . $mail->ErrorInfo;
            }
        } else {
            $error_message = "Registration failed. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | বই</title>
    
    <!-- CSS Bundles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/icons/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js" charset="utf-8"></script>

    <style>
        body { background-color: #f8f9fa; }
        .signup-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .signup-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }
        .btn-signup {
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: transform 0.2s;
        }
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        .uploadcare--widget__button {
            background-color: #667eea;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php include "includes/components/nav.php"; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card signup-card">
                    <div class="row g-0">
                        <div class="col-md-5 signup-image d-none d-md-flex p-5 text-white text-center flex-column justify-content-center">
                            <h2 class="fw-bold mb-4">Join Our Community</h2>
                            <p class="mb-5">Connect with thousands of book lovers and give your old books a new home.</p>
                            
                            <?php
                            $stmt_sl = mysqli_prepare($connection, "SELECT image FROM slider2");
                            mysqli_stmt_execute($stmt_sl);
                            $res_sl = mysqli_stmt_get_result($stmt_sl);
                            if ($row_sl = mysqli_fetch_assoc($res_sl)): ?>
                                <img src="<?php echo htmlspecialchars($row_sl["image"]); ?>" class="img-fluid rounded shadow" alt="Signup Illustration">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-7 p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold">Create Account</h2>
                                <p class="text-muted">Fill in your details to get started</p>
                            </div>

                            <?php if ($success_message): ?>
                                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                    <i class="fas fa-check-circle me-2"></i> <?php echo $success_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($error_message): ?>
                                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $error_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form action="" method="POST" class="needs-validation" novalidate>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Full Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone Number</label>
                                        <input type="tel" name="phone" class="form-control" placeholder="01XXXXXXXXX" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Address</label>
                                        <textarea name="address" class="form-control" rows="2" placeholder="Your current location" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Confirm Password</label>
                                        <input type="password" id="confirm_password" class="form-control" placeholder="••••••••" required>
                                        <div id="password-match-msg" class="form-text mt-1"></div>
                                    </div>
                                    <div class="col-12 my-3">
                                        <label class="form-label fw-bold me-3">Profile Picture</label>
                                        <input type="hidden" name="file" role="uploadcare-uploader" data-clearable="true" data-crop="free">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="terms" required>
                                            <label class="form-check-label small text-muted" for="terms">
                                                I agree to the <a href="#" class="text-primary text-decoration-none">Terms and Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button type="submit" name="submit" id="submit-btn" class="btn btn-primary btn-signup text-white py-3">
                                            Sign Up Now
                                        </button>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <p class="text-muted mb-0">Already have an account? <a href="login" class="text-primary fw-bold text-decoration-none">Log In</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        UPLOADCARE_LOCALE = "en";
        UPLOADCARE_LIVE = false;
        UPLOADCARE_PUBLIC_KEY = '17b0d03f8e05e110e978';

        $(document).ready(function() {
            $('#password, #confirm_password').on('keyup', function() {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#password-match-msg').html('<i class="fas fa-check-circle"></i> Passwords match').removeClass('text-danger').addClass('text-success');
                    $('#submit-btn').prop('disabled', false);
                } else {
                    $('#password-match-msg').html('<i class="fas fa-times-circle"></i> Passwords do not match').removeClass('text-success').addClass('text-danger');
                    $('#submit-btn').prop('disabled', true);
                }
            });

            // Bootstrap validation
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
        });
    </script>

    <div class="progress-bar fixed-bottom" id="myBar" style="height:4px; background: #667eea; width: 0%;"></div>
    <?php include "includes/components/footer.php"; ?>
</body>
</html>
