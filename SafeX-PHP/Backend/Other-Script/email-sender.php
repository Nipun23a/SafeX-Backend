
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer\src\Exception.php";
require "phpmailer\src\PHPMailer.php";
require "phpmailer\src\SMTP.php";

function emailSender($receiverAddress,$companyName,$randomPassword){
    $mail = new PHPMailer(true);
    $mail -> isSMTP();
    $mail -> SMTPAuth = true;
    $mail -> Host = 'smtp.gmail.com';
    $mail -> Username = "johnsillva734@gmail.com";
    $mail -> Password = "jvbbpmrngowbktgc ";
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;

    $mail -> setFrom('johnsillva734@gmail.com');
    $mail -> addAddress($receiverAddress);
    $mail -> isHTML(true);
    $mail -> Subject = ("$companyName, Welcome to SafeX");
    $mail -> Body =("Dear $companyName,\n\nYour temporary password is: $randomPassword\n\nPlease login to your account and change your password immediately.\n\nRegards,\nSafeX Team");
    $mail -> send();
    try {
        $mail->send();
        echo "Email sent successfully";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function reminderEmailSender($receiverAddress,$companyName){
    $mail = new PHPMailer(true);
    $mail -> isSMTP();
    $mail -> SMTPAuth = true;
    $mail -> Host = 'smtp.gmail.com';
    $mail -> Username = "johnsillva734@gmail.com";
    $mail -> Password = "jvbbpmrngowbktgc ";
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;

    $mail -> setFrom('johnsillva734@gmail.com');
    $mail -> addAddress($receiverAddress);
    $mail -> isHTML(true);
    $mail -> Subject = ("$companyName, Cloud Subscription");
    $mail -> Body =("Dear $companyName,\n\nyour SafeX cloud subcription has expired. Please renew it as soon as possible.\n\nRegards,\nSafeX Team");
    $mail -> send();
    try {
        $mail->send();
        echo "Email sent successfully";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function employeeEmailSender($receiverAddress, $employeeName, $randomUsername, $randomPassword){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = "johnsillva734@gmail.com";
    $mail->Password = "jvbbpmrngowbktgc ";
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('johnsillva734@gmail.com');
    $mail->addAddress($receiverAddress);
    $mail->isHTML(true);
    $mail->Subject = "$employeeName, Welcome to SafeX";
    $mail->Body = "Dear $employeeName,<br><br>Your temporary username: $randomUsername and password is: $randomPassword<br><br>Please login to your account and change your password immediately.<br><br>Regards,<br>SafeX Team";

    try {
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}

?>