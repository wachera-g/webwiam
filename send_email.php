<?php
//Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$message = $_POST['message'];

//Validating form data
if (empty($full_name) || empty($email) || empty($message)) {
    echo 'Please fill in all fields.';
    exit;
}

// Email configuration
$host = 'mail.eternityin-amoment.org'; // Replace with your SMTP host
$port = 465; // Port number for SSL
$username = 'info@eternityin-amoment.org'; // Your email address
$password = 'EternityInAMoment9827!_!*!_!*!_!'; // Your email password
$recipient_email = 'info@eternityin-amoment.org'; // Recipient email (your own email)

// Set up PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $port;

    // Recipients
    $mail->setFrom($username, 'Eternity in a Moment');
    $mail->addAddress($recipient_email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Inquiry from Website';
    $mail->Body = "<strong>Name:</strong> $full_name<br>
                   <strong>Email:</strong> $email<br>
                   <strong>Message:</strong><br>$message";

    $mail->send();
    echo 'Your message has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
