<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../includes/config/dbconfig.php";
include "../includes/config/mail_config.php";

// Function to update datetime
function getCurrentDateTime() {
    date_default_timezone_set("Asia/Dhaka");
    return date("Y-m-d H:i:s");
}

/* -------------------------------------------------------------------------- */
/*                          1. Admin Registration                            */
/* -------------------------------------------------------------------------- */
if (isset($_POST["registerbtn"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmpassword"];
    $datetime = getCurrentDateTime();

    if ($password === $confirm_password) {
        $hashed_password = md5($password);
        
        $stmt = mysqli_prepare($connection, "INSERT INTO adminpanel (username, email, password, status, created_date, updated_date) VALUES (?, ?, ?, 1, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashed_password, $datetime, $datetime);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION["success"] = "Admin account created successfully.";
            header("Location: register.php");
        } else {
            $_SESSION["status"] = "Error creating admin account: " . mysqli_error($connection);
            header("Location: register.php");
        }
    } else {
        $_SESSION["status"] = "Passwords do not match.";
        header("Location: register.php");
    }
    exit();
}

/* -------------------------------------------------------------------------- */
/*                          2. Admin Profile Update                           */
/* -------------------------------------------------------------------------- */
if (isset($_POST["updatebtn"])) {
    $id = $_POST["edit_id"];
    $username = trim($_POST["edit_username"]);
    $email = trim($_POST["edit_email"]);
    $password = !empty($_POST["edit_password"]) ? md5($_POST["edit_password"]) : null;
    $status = $_POST["edit_status"];
    $datetime = getCurrentDateTime();

    if ($password) {
        $stmt = mysqli_prepare($connection, "UPDATE adminpanel SET username = ?, email = ?, password = ?, status = ?, updated_date = ? WHERE admin_id = ?");
        mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $password, $status, $datetime, $id);
    } else {
        $stmt = mysqli_prepare($connection, "UPDATE adminpanel SET username = ?, email = ?, status = ?, updated_date = ? WHERE admin_id = ?");
        mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $status, $datetime, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "Admin profile updated successfully.";
        header("Location: register.php");
    } else {
        $_SESSION["status"] = "Failed to update admin profile.";
        header("Location: register.php");
    }
    exit();
}

/* -------------------------------------------------------------------------- */
/*                   3. Book Data Update (Review/Approval)                   */
/* -------------------------------------------------------------------------- */
if (isset($_POST["updatebtnbook"])) {
    $id = $_POST["edit_id_book"];
    $details = $_POST["edit_details"];
    $status = $_POST["edit_status"];
    $price = $_POST["edit_price"] ?? 0;
    $mailid = $_POST["mail"];
    $mail_name = $_POST["mail_name"];
    $datetime = getCurrentDateTime();

    $stmt = mysqli_prepare($connection, "UPDATE books SET present_condition = ?, status = ?, price = ?, updated_date = ? WHERE book_id = ?");
    mysqli_stmt_bind_param($stmt, "siisi", $details, $status, $price, $datetime, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        $mail_sent = false;
        try {
            $mail = getPHPMailer();
            $mail->addAddress($mailid, $mail_name);
            $mail->isHTML(true);
            
            $mail->Subject = "Update Regarding Your Book Listing: " . htmlspecialchars($id);
            $status_text = ($status == 1) ? "published and is now live" : "reviewed and updated by our moderator";
            
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; padding: 30px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; margin: auto;'>
                    <h2 style='color: #4e73df;'>Greetings, " . htmlspecialchars($mail_name) . "!</h2>
                    <p style='font-size: 16px; line-height: 1.6;'>Your book listing (ID: <strong>$id</strong>) has been $status_text.</p>
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='http://boi-yourbook.herokuapp.com/book?book=$id' 
                           style='background-color: #4e73df; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;'>
                           View My Listing
                        </a>
                    </div>
                    <p style='font-size: 14px; color: #666;'>Thank you for being a part of our community!</p>
                    <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
                    <p style='font-size: 11px; color: #999; text-align: center;'>This is an automated system message. Please do not reply directly to this email.</p>
                </div>";
            
            $mail->send();
            $mail_sent = true;
        } catch (Exception $e) {
            $_SESSION["status"] = "Data saved, but notification failed: " . $mail->ErrorInfo;
        }
        
        if ($mail_sent) {
            $_SESSION["success"] = "Book listing updated and user notified.";
        }
        header("Location: bookinfo.php");
    } else {
        $_SESSION["status"] = "Database error: Failed to update book details.";
        header("Location: bookinfo.php");
    }
    exit();
}

/* -------------------------------------------------------------------------- */
/*                           4. User Status Update                            */
/* -------------------------------------------------------------------------- */
if (isset($_POST["updatebtnuser"])) {
    $id = $_POST["edit_id_user"];
    $status = $_POST["edit_status"];
    $datetime = getCurrentDateTime();

    $stmt = mysqli_prepare($connection, "UPDATE user SET status = ?, updated_date = ? WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "isi", $status, $datetime, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["success"] = "User status has been updated.";
        header("Location: userinfo.php");
    } else {
        $_SESSION["status"] = "Error updating user status.";
        header("Location: userinfo.php");
    }
    exit();
}

/* -------------------------------------------------------------------------- */
/*                            5. Broadcast Email                              */
/* -------------------------------------------------------------------------- */
if (isset($_POST["sendmail"])) {
    $subject = $_POST["subject"];
    $body = $_POST["body"];
    $datetime = getCurrentDateTime();

    try {
        $mail = getPHPMailer();
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Fetch all active user emails
        $stmt_users = mysqli_prepare($connection, "SELECT email FROM user WHERE status = 1");
        mysqli_stmt_execute($stmt_users);
        $res_users = mysqli_stmt_get_result($stmt_users);
        
        $count = 0;
        while ($row = mysqli_fetch_assoc($res_users)) {
            $mail->addBCC($row["email"]);
            $count++;
        }

        if ($count > 0) {
            $mail->send();
            
            // Log the mail in history
            $stmt_log = mysqli_prepare($connection, "INSERT INTO mail (subject, body, date) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt_log, "sss", $subject, $body, $datetime);
            mysqli_stmt_execute($stmt_log);
            
            $_SESSION["success"] = "Success! Broadcast email sent to $count active users.";
        } else {
            $_SESSION["status"] = "No active users found to receive the broadcast.";
        }
    } catch (Exception $e) {
        $_SESSION["status"] = "Mailer Execution Failed: " . $mail->ErrorInfo;
    }
    
    header("Location: mail.php");
    exit();
}
?>
<!-- Footer JS dependencies for inclusion -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
