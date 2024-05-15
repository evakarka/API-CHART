<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];

    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    $mysqli = require __DIR__ . "/database.php";

    $sql = "UPDATE users
            SET reset_token_hash = ?,
                reset_token_expires_at = ?
            WHERE email = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($mysqli->affected_rows) {
        require __DIR__ . "/vendor/autoload.php";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "your_email@gmail.com"; 
        $mail->Password = "your_password"; 
        $mail->isHtml(true);

        $mail->setFrom("your_email@gmail.com"); 
        $mail->addAddress($email);

        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
        Click <a href="http://localhost/API-CHART/front-end/reset-password.php?token=$token">here</a> 
        to reset your password.
        END;

        try {
            $mail->send();
            echo "Message sent, please check your inbox.";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
    } else {
        echo "User not found!";
    }
}
?>
