<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: chart.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    
<div class="container">
        <div class="box form-box">
        <header>Login</header>

        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>

            <form method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have account? <a href="signup.html">Sign Up Now</a>
                </div>
            </form>

            <a href="forgot-password.php">Forgot Password?</a>
        </div>
    </div>

</body>
</html>