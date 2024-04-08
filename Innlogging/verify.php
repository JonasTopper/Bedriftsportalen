<?php

error_reporting(E_ALL);
ini_set('display_errors', 2);

session_start();
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the verification code entered by the user
    $verification_code_1 = isset($_POST['verification_code_1']) ? $_POST['verification_code_1'] : '';
    $verification_code_2 = isset($_POST['verification_code_2']) ? $_POST['verification_code_2'] : '';
    $verification_code_3 = isset($_POST['verification_code_3']) ? $_POST['verification_code_3'] : '';
    $verification_code_4 = isset($_POST['verification_code_4']) ? $_POST['verification_code_4'] : '';
    $verification_code_5 = isset($_POST['verification_code_5']) ? $_POST['verification_code_5'] : '';

    // Concatenate the verification codes
    $verification_code = $verification_code_1 . $verification_code_2 . $verification_code_3 . $verification_code_4 . $verification_code_5;

    $actual_verification_code = "44839"; 

    // Check if the entered verification code matches the actual verification code
    if ($verification_code == $actual_verification_code) {
        $_SESSION['is_verified'] = true;
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        header("Location: Login.php");
        exit();
    } else {
        //echo "<p>Verification failed. Please enter the correct verification code.</p>";
        $_SESSION['is_verified'] = false;
        sleep(1);
        header("Location: ../Verification.php");
    }
}
