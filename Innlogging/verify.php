<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the verification code entered by the user
    $verification_code = isset($_POST['verification_code']) ? $_POST['verification_code'] : '';

    // You can replace this with your actual verification code
    $actual_verification_code = "12345"; // Example verification code

    // Check if the entered verification code matches the actual verification code
    if ($verification_code == $actual_verification_code) {
        // Verification successful
        echo "<p>Verification successful. You are now verified. Redirecting..</p>";
        header("Location: Registration.php");
    } else {
        // Verification failed
        echo "<p>Verification failed. Please enter the correct verification code.</p>";
    }
} else {
    // If the form has not been submitted, redirect back to the verification page
    header("Location: ../Verification.php");
    exit();
}
