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
    <title>COVID-19 Journo - Chart</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    
</head>
<body>

<body class="bg-light">
    <div class="nav">
        <div class="logo">
            <p><a href="intex.php">COVID-19 Journo</a></p>
        </div>

        <div class="right-links">
            <!-- <a href="profile.php">Logout</a> -->
            <a class="btn btn-outline-primary btn-sm" href="logout.php">Logout</a>
        </div>
    </div>

    <!-- VALE MESA SAN CHART -->
    <div class="card text-center m-5">
    <div class="card-header">
    
    <h2 class="text-center">COVID-19</h2>
    </div>
    <canvas id="myChart" width="800" height="300"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- VALE MESA SAN CHART -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>