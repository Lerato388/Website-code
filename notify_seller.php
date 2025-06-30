<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'youremail@gmail.com';
    $mail->Password = 'your_app_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('youremail@gmail.com', 'Swapify Admin');
    $mail->addAddress('yourreceiver@gmail.com', 'Test User');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'PHPMailer Test';
    $mail->Body    = 'This is a test email sent from PHPMailer on your Swapify website.';

    $mail->send();
    echo '✅ Test email sent successfully!';
} catch (Exception $e) {
echo "<h2>Email notification simulated.</h2>";
echo "<p>The seller would be notified via email about the approval/decline status.</p>"

}
?>
