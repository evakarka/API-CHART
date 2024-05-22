<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

$host = "localhost";
$dbname = "chart_data";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM charts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Chart Data</title>
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="style/styles.css">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      font-family: 'Montserrat', sans-serif;
      background-color: #0d0d2b;
      color: white;
    }

    .navbar {
      position: fixed;
      top: 20px;
      left: 20px;
      right: 20px;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      font-size: 16px;
      align-items: center;
      transition: background 0.3s, color 0.1s, top 0.3s, left 0.3s, right 0.3s, padding 0.3s, margin 0.3s, box-shadow 0.3s;
      z-index: 1000;
    }

    .navbar a {
      color: inherit;
      text-decoration: none;
      font-weight: 600;
      margin: 0 15px;
      transition: color 0.3s;
    }

    .nav-links {
      display: flex;
    }

    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
    }

    .hamburger div {
      width: 25px;
      height: 3px;
      background-color: white;
      margin: 4px;
      transition: all 0.3s ease;
    }

    .content {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 80px;
      padding: 20px;
      gap: 20px;
      width: 100%;
      background-color: #1f1f44;
    }

    .card {
      background-color: #292948; 
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      color: #f3f4f6;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card h2 {
      color: #FF4081;
      margin-bottom: 15px;
    }

    .card p {
      color: #d1d1d1; 
      margin-bottom: 15px;
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
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #D93670;
    }

    .footer {
      background: #0C0C27;
      color: #ff4081;
      text-align: center;
      padding: 20px;
    }

    .footer a {
      color: #ff4081;
      text-decoration: none;
      margin: 0 10px;
      font-weight: 600;
    }

    .footer a:hover {
      color: #e00070;
    }
  </style>
</head>
<body>
<div class="navbar" id="navbar">
  <div class="logo">
    <a href="index.php" style="font-size: 20px;">DailyNewsChart</a>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="service.php">Services</a>
    <a href="contact.php">Contact</a>
    <a href="upload.html">Add Chart</a>
    <?php if (isset($user)): ?>
      <a href="logout.php" class="text-white text-decoration-none px-3 py-1 rounded-4">Logout</a>
    <?php endif; ?>
  </div>
  <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<div class="content">
  <div class="card-container">
  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<div class='card'>";
          echo "<h2>" . htmlspecialchars($row["chart_name"]) . "</h2>";
          echo "<p>" . htmlspecialchars($row["chart_description"]) . "</p>";
          echo "<p>" . htmlspecialchars($row["chart_type"]) . "</p>";
          echo "<a href='chart.php?id=" . htmlspecialchars($row["id"]) . "' class='btn'>See</a>";
          echo "</div>";
      }
  } else {
      echo "No results found";
  }
  $conn->close();
  ?>
  </div>
</div>

<div class="footer">
  <p class="fs-5">&copy; 2024 DailyNewsChart. All rights reserved.</p>
  <p class="fs-5">
    <a href="#">Privacy Policy</a> | 
    <a href="#">Terms of Service</a> | 
    <a href="contact.php">Contact Us</a>
  </p>
</div> 

<script>
const hamburger = document.getElementById("hamburger");
const navLinks = document.getElementById("navLinks");

hamburger.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});
</script>
</body>
</html>
