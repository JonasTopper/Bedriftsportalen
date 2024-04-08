<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPmailer/src/Exception.php';
require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';

if(isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "bedriftportalen@gmail.com";
    $mail->Password = "ltst hviz inan potp";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->setFrom('bedriftportalen@gmail.com');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = "Bedriftsportalen bekreftelseskode";
    $mail->Body = "
    <p>Velkommen til Bedriftsportalen!
    <br> <br>
    Din verifiseringskode er: 0408f32
    <br> <br>
    Med vennlig hilsen,
    Bedriftsportalen Developers</p>
    <p><img src=\"cid:image1\" alt=\"Image\"></p>
    ";

    $imagePath = 'images/logo_no_slogan.png';

    $mail->addEmbeddedImage($imagePath, 'image1');

    $mail->send();

    if ($mail->send()) {
        header("Location: verification.php");
        exit(); 
    } else {
        echo "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }
}
