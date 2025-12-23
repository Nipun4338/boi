<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Only require autoload if not already included
if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    // Determine path based on folder depth
    if (file_exists('admin/vendor/autoload.php')) {
        require 'admin/vendor/autoload.php';
    } elseif (file_exists('vendor/autoload.php')) {
        require 'vendor/autoload.php';
    } elseif (file_exists('../admin/vendor/autoload.php')) {
        require '../admin/vendor/autoload.php';
    } elseif (file_exists('../../admin/vendor/autoload.php')) {
        require '../../admin/vendor/autoload.php';
    }
}

/**
 * Helper function to get a pre-configured mailer instance
 * @param string $from_name Optional sender name
 * @return PHPMailer
 */
function getPHPMailer($from_name = "Boi Administration") {
    $mail = new PHPMailer(true);
    
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "boi.yourbook@gmail.com";
    $mail->Password = "ejnw nqrk kadc tpps"; // Google App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    // SSL Verification Bypass (Commonly needed for local XAMPP environments)
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    $mail->setFrom("boi.yourbook@gmail.com", $from_name);
    return $mail;
}

/**
 * Helper to get the base URL of the site
 */
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    
    // Check if we are in a subdirectory (like /boi)
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $path = str_replace(basename($scriptName), '', $scriptName);
    
    // If we are in /admin, strip it
    $path = str_replace('/admin/', '/', $path);
    
    return $protocol . $domainName . $path;
}
?>
