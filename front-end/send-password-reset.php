<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Ελέγχουμε αν έχει γίνει POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Παίρνουμε το email από τη φόρμα
    $email = $_POST["email"];

    // Δημιουργούμε το reset token
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    // Σύνδεση στη βάση δεδομένων
    $mysqli = require __DIR__ . "/database.php";

    // Ενημέρωση του χρήστη στη βάση δεδομένων με το reset token και τον χρόνο λήξης
    $sql = "UPDATE users
            SET reset_token_hash = ?,
                reset_token_expires_at = ?
            WHERE email = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($mysqli->affected_rows) {
        // Φορτώνουμε τη βιβλιοθήκη PHPMailer
        require __DIR__ . "/vendor/autoload.php";

        // Δημιουργία αντικειμένου PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "your_email@gmail.com"; // Εισάγετε το email σας
        $mail->Password = "your_password"; // Εισάγετε τον κωδικό του email σας
        $mail->isHtml(true);

        // Ορισμός αποστολέα και παραλήπτη
        $mail->setFrom("your_email@gmail.com"); // Εισάγετε το email σας
        $mail->addAddress($email);

        // Θέμα και κείμενο email
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
        Click <a href="http://localhost/API-CHART/front-end/reset-password.php?token=$token">here</a> 
        to reset your password.
        END;

        try {
            // Αποστολή email
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
}
?>
