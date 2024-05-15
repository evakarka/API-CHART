<?php

$is_invalid = false;
$empty_fields_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $mysqli = require __DIR__ . "/database.php";

        $email = $mysqli->real_escape_string($_POST["email"]);

        $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $email);

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($_POST["password"], $user["password_hash"])) {
                session_start();
                session_regenerate_id();
                $_SESSION["user_id"] = $user["id"];
                header("Location: explore.php");
                exit;
            }
        }

        $is_invalid = true;
    } else {
        $empty_fields_error = "Please fill in both email and password fields.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="icon" href="/img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0d2b;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .box {
            background-color: #0C0C27;
            border-radius: 10px;
            padding: 40px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .box header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .field input[type="text"],
        .field input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #0C0C27;
            color: white;
        }

        .field input[type="submit"] {
            width: 100%;
            padding: 4px 10px; 
            font-size: 18px;
            border: none;
            border-radius: 5px;
            background-color: #ff4081;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .field input[type="submit"]:hover {
            background-color: #e00070;
        }

        .links {
            margin-top: 20px;
            text-align: center;
        }

        .links a {
            color: #ff4081;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .error {
            color: #ff4081;
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    
<div class="container">
    <div class="box form-box">
        <header>Login</header>

        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>

        <?php if (!empty($empty_fields_error)): ?>
            <em><?= $empty_fields_error ?></em>
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
