<?php

$token = $_POST["token"];

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found!");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired!");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters!");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter!");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number!");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match!");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["id"]);

$stmt->execute();

// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "codiv19journo@gmail.com";
$mail->Password = "hvdqkxboqxbezcbb"; 

$mail->isHtml(true);

$mail->setFrom("codiv19journo@gmail.com");
$mail->addAddress($user["email"]);

$mail->Subject = "Password Reset";
$mail->Body = <<<END
Click <a href="http://localhost/API-CHART/front-end/reset-password.php?token=$token">here</a> 
to reset your password.
END;

try {
    $mail->send();
    header("Location: password-reset-success.html");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
}

?>
