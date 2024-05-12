<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>COVID-19 Journo</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<body class="bg-light">
    <div class="nav">
        <div class="logo">
            <p><a href="home.html">COVID-19 Journo</a></p>
        </div>

        <div class="right-links">
            <!-- <a class="btn btn-outline-primary btn-sm" href="profile.php">Profile</a> -->
            <a class="btn btn-outline-primary btn-sm" href="logout.php">Logout</a>
        </div>
    </div>

    
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-md-3">
                <h2 class="text-center mt-4 mb-4">Scientific Journals on COVID-19 Global Data</h2>
                <br>
                <div class="input-group mb-3">
                    <p>
                    This application calls upon WHO COVID-19 global data published in 
                        <a href="https://covid19.who.int">World Health Organization (WHO).</a>
                    </p>
                    <p>
                    To utilize it, you need to log in to the platform.
                    </p>
                </div>

                <?php if (isset($user)): ?>
                    
                    <p><a class="btn btn-outline-primary btn-sm" href="logout.php">Logout</a></p>
                    
                <?php else: ?>
                    
                    <p><br><a class="btn btn-outline-primary btn-sm" href="login.php">Login</a> or <a class="btn btn-outline-primary btn-sm" href="signup.html">Register</a></p>
                    
                <?php endif; ?>
            </div>
        </div>
    </div>

    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    