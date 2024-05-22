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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Data</title>
  <link rel="stylesheet" href="style/styles.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f3f4f6;
      color: #333;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }
    .navbar {
      width: 100%;
      background-color: #4A5568;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      z-index: 1000;
    }
    .navbar a {
      color: #fff;
      text-decoration: none;
      margin: 0 15px;
      font-size: 18px;
    }
    .logo a {
      font-size: 24px;
      font-weight: bold;
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
      background-color: #fff;
      margin: 4px 0;
    }
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 80px;
      padding: 20px;
      gap: 20px;
      width: 100%;
    }
    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card h2 {
      color: #2B6CB0;
      margin-bottom: 15px;
    }
    .card p {
      color: #666;
      margin-bottom: 15px;
    }
    .btn {
      background-color: #2B6CB0;
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
      background-color: #2C5282;
    }
    @media (max-width: 768px) {
      .nav-links {
        display: none;
        flex-direction: column;
        background-color: #4A5568;
        position: absolute;
        top: 60px;
        width: 100%;
        left: 0;
        text-align: center;
      }
      .nav-links a {
        margin: 10px 0;
      }
      .hamburger {
        display: flex;
      }
      .hamburger.active + .nav-links {
        display: flex;
      }
    }
  </style>
</head>
<body>
<div class="navbar">
  <div class="logo">
    <a href="index.php">DailyNewsChart</a>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="service.php">Services</a>
    <a href="contact.php">Contact</a>
    <a href="upload.html">Add Chart</a>
  </div>
  <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<div class="card-container">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<h2>" . $row["chart_name"] . "</h2>";
        echo "<p>" . $row["chart_description"] . "</p>";
        echo "<p>" . $row["chart_type"] . "</p>";
        echo "<a href='chart.php?id=" . $row["id"] . "' class='btn'>See</a>";
        echo "</div>";
    }
} else {
    echo "No results found";
}
$conn->close();
?>
</div>

<script>
  document.getElementById("hamburger").addEventListener("click", function() {
    this.classList.toggle("active");
    document.getElementById("navLinks").classList.toggle("active");
  });
</script>
</body>
</html>
