<?php
require_once 'vendor/autoload.php'; // Adjust the path based on your project structure

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['email']) && isset($data['otp'])) {
    $email = $data['email'];
    $otp = $data['otp'];


    // Save the OTP in the session variable
    $_SESSION['otp'] = $otp;

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mytestdomainweb.website'; // Change to your SMTP host
        $mail->SMTPAuth   = true;
        $mail->Username   = 'atmtest@mytestdomainweb.website'; // Change to your SMTP username
        $mail->Password   = 'cN0ZV[tchfyr'; // Change to your SMTP password
        $mail->SMTPSecure = 'ssl'; // Use 'tls' or 'ssl' based on your SMTP server
        $mail->Port       = 465; // Adjust the port based on your SMTP server configuration

        // Recipients
        $mail->setFrom('atmtest@mytestdomainweb.website', 'ATM SECURE TEST'); // Change to your sender details
        $mail->addAddress($email); // Add the recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Secure ATM';
        $mail->Body    = 'Your OTP is: ' . $otp;

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false]);
}



