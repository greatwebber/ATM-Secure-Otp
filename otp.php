<?php
session_start(); // Start the session

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['otp'])) {
    $userProvidedOTP = $data['otp'];

    // Retrieve the saved OTP from the session
    $savedOTP = isset($_SESSION['otp']) ? $_SESSION['otp'] : null;

    if ($userProvidedOTP == $savedOTP) {
        echo json_encode(['success' => true, 'message' => 'OTP verification successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'OTP verification failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
