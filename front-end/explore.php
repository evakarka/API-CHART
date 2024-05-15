<?php
$host = "localhost";
$dbname = "chart_data";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σύνδεση απέτυχε: " . $conn->connect_error);
}

$sql = "SELECT * FROM charts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h2 class='card-title'>" . $row["chart_name"] . "</h2>";
        echo "<p class='card-text'>" . $row["chart_description"] . "</p>";
        echo "<p class='card-text'>" . $row["chart_type"] . "</p>";

        echo "<a href='chart.php?file_id=" . $row["file_id"] . "' class='btn'>See</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No results found";
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chart Data</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #0d0d2b;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .card {
      background-color: #1f1f44;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 20px;
      width: 300px;
      text-align: center;
    }
    h2 {
      color: #FF4081;
      margin-bottom: 10px;
    }
    p {
      color: #ddd;
      margin-bottom: 20px;
    }
    .btn {
      background-color: #FF4081;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
    }
    .btn:hover {
      background-color: #f30053;
    }
  </style>
</head>
<body>
    
</body>
</html>
