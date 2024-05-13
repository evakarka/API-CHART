<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    $mail->Username = "codiv19journo@gmail.com"; // Λογαριασμός χρήστη
    $mail->Password = "hvdqkxboqxbezcbb"; // Κωδικός πρόσβασης

    $mail->isHtml(true);

    // Ορισμός αποστολέα και προσθήκη διεύθυνσης παραλήπτη
    $mail->setFrom("codiv19journo@gmail.com");
    $mail->addAddress($email);

    // Θέμα και κείμενο του μηνύματος
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
    Click <a href="http://localhost/API-CHART/front-end/reset-password.php?token=$token">here</a> 
    to reset your password.
    END;

    try {
        // Αποστολή του email
        $mail->send();
        echo "Message sent, please check your inbox.";
    } catch (Exception $e) {
        // Εκτύπωση σφάλματος σε περίπτωση που αποτύχει η αποστολή
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
} else {
    // Περίπτωση που δεν βρέθηκε κανένας χρήστης με το συγκεκριμένο email
    echo "User not found!";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="icon" href="/img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Reset Password</header>

            <form method="post" action="send-password.php">
                <!-- Πεδίο εισαγωγής email -->
                <div class="field input">
                    <label for="email">Your email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <!-- Κρυφό πεδίο για το reset token -->
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <!-- Πεδία εισαγωγής νέου κωδικού και επιβεβαίωσης κωδικού -->
                <div class="field input">
                    <label for="password">New password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="field input">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>

                <!-- Κουμπί υποβολής -->
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Reset Password">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
