<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Including required PHPMailer files
require 'PHPmailer/src/Exception.php';
require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';

// Verify user before proceeding
require 'Innlogging/verify.php';

// Check if the form is submitted
if (isset($_POST["send"])) {
    // Create a new instance of PHPMailer
    $mail = new PHPMailer(true);

    // Configure PHPMailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "bedriftportalen@gmail.com";
    $mail->Password = "ltst hviz inan potp"; // Password for SMTP authentication
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    // Set the sender email address
    $mail->setFrom('bedriftportalen@gmail.com');

    // Add recipient email address
    $mail->addAddress($_POST["email"]);

    // Enable HTML content in the email
    $mail->isHTML(true);

    // Set email subject and body
    $mail->Subject = "Bedriftsportalen bekreftelseskode";
    $mail->Body = "
    <p>Velkommen til Bedriftsportalen!
    <br> <br>
    Din verifiseringskode er: $actual_verification_code
    <br> <br>
    Med vennlig hilsen,
    Bedriftsportalen Developers</p>
    <p><img src=\"cid:image1\" alt=\"Image\"></p>
    ";

    // Add embedded image
    $imagePath = 'images/logo_no_slogan.png';
    $mail->addEmbeddedImage($imagePath, 'image1');

    $mail->send();

    // Check if email is sent successfully
    if ($mail->send()) {
        // Redirect to verification page
        header("Location: verification.php");
        exit();
    } else {
        // Display error message if email fails
        echo "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}