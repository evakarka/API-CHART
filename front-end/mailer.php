<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// * In case the email isn't being sent we use this function
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; 

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "codiv19journo@gmail.com"; 
$mail->Password = "hvdqkxboqxbezcbb"; 

$mail->isHtml(true);

return $mail;