<?php
$host = "localhost";
$dbname = "chart_data";
$username = "root";
$password = "";

// Σύνδεση στη βάση δεδομένων
$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

// Λήψη των δεδομένων από τη φόρμα
$chartName = $_POST['chart-name'] ?? '';
$chartDescription = $_POST['chart-description'] ?? '';
$chartType = $_POST['chart-type'] ?? '';
$chartData = $_POST['chart-data'] ?? '';

if (empty($chartName) || empty($chartDescription) || empty($chartType) || empty($chartData)) {
    die("All fields are required.");
}

// Προετοιμασία της δήλωσης
$stmt = $mysqli->prepare("INSERT INTO charts (chart_name, chart_description, chart_type, chart_data, file_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $chartName, $chartDescription, $chartType, $chartData, $fileId);

// Λήψη του file_id από τον πίνακα charts
$fileId = 1; // Εδώ θα πρέπει να το λάβετε από τη βάση δεδομένων ή να το παράγετε δυναμικά

// Εκτέλεση της δήλωσης
if ($stmt->execute()) {
    echo "New record created successfully. Your chart has been uploaded.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
