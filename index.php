<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVID-19 Journo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">COVID-19 Journo</a></p>
        </div>

        <div class="right-links">
            <?php

            $id = $_SESSION['id'];

            // Ελέγχουμε εάν η τιμή του $id είναι διαθέσιμη και έγκυρη
            if (!empty($id) && is_numeric($id)) {
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Useraname'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_id = $result['Id'];
                }

                echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            } else {
                echo "Invalid user ID";
            }
            ?>

            <a href="#">Change Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button></a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-md-3">
                <h2 class="text-center mt-4 mb-4">Scientific Journals on COVID-19 Global Data</h2>
                <div class="input-group mb-3">
                    <p>
                    This application calls upon WHO COVID-19 global data published in 
                        <a href="https://covid19.who.int">World Health Organization (WHO).</a>
                    </p>
                    <p>
                    To utilize it, you need to log in to the platform.
                    </p>
                </div>

                <div class="input-group mb-3">
                    <button class="btn btn-primary" type="button">Login</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid text-center">
        <p>Copyright © 2024 - Eva Karka</p>
    </footer>
</body>

</html>
