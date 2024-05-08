<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Reset Password</header>

            <form method="post" action="process-reset-password.php">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="field input">
                    <label for="password">New password</label>
                    <input type="password" id="password" name="password">
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>

                <div class="field input">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
