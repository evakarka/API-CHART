<?php

$mysqli = require __DIR__ . "/database.php";

if(isset($_GET["email"]) && filter_var($_GET["email"], FILTER_VALIDATE_EMAIL)) {
    $email = $mysqli->real_escape_string($_GET["email"]);

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $email);

    $result = $mysqli->query($sql);

    $is_available = $result->num_rows === 0;

    header("Content-Type: application/json");

    echo json_encode(["available" => $is_available]);
} else {
    $error_message = "Invalid email address.";
    header("Content-Type: application/json");
    echo json_encode(["error" => $error_message]);
}

?>
