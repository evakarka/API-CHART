<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "chart_data";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT chart_data FROM charts WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $chart_data = $row['chart_data'];

        if (!empty($chart_data)) {
            $csv_filename = 'chart_data.csv';

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $csv_filename . '"');

            echo $chart_data;
            exit();
        } else {
            echo "No data found for CSV.";
        }
    } else {
        echo "No results were found for the specified ID.";
    }
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
