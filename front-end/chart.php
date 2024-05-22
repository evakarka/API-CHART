<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "chart_data";

// Δημιουργία σύνδεσης με τη βάση δεδομένων
$conn = new mysqli($host, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Πάρε το ID από το URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$data = array();
if ($id > 0) {
    // Χρήση prepared statements για ασφαλή SQL ερώτημα
    $stmt = $conn->prepare("SELECT * FROM charts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Δημιουργία των δεδομένων για το γράφημα ECharts
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Προσθήκη δεδομένων στον πίνακα $data
        $data['chart_name'] = $row['chart_name'];
        $data['chart_description'] = $row['chart_description'];
        $data['chart_type'] = $row['chart_type'];
        $data['chart_data'] = json_decode($row['chart_data'], true);
    } else {
        echo "No results were found for the specified ID.";
    }
    $stmt->close();
} else {
    echo "Invalid ID.";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($data['chart_name']) ? htmlspecialchars($data['chart_name']) : 'Chart name'; ?></title>
  <!-- Εισαγωγή της βιβλιοθήκης ECharts -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: #0D0D2B;
      color: #fff;
    }
    #chart-container {
      width: 100%;
      max-width: 800px;
      height: 600px;
      margin: 20px 0;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px 0;
      background-color: #FF4081;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #f30053;
    }
    pre {
      background: #272822;
      color: #f8f8f2;
      padding: 10px;
      border-radius: 5px;
      overflow-x: auto;
      max-width: 100%;
      white-space: pre-wrap;
      word-wrap: break-word;
    }
    h1 {
      color: #FF4081;
    }
  </style>
</head>
<body>
  <?php if (isset($data) && !empty($data)): ?>
    <h1><?php echo htmlspecialchars($data['chart_name']); ?></h1>
    <p><?php echo htmlspecialchars($data['chart_description']); ?></p>
    <!-- Προσθήκη συνδέσμου για τη λήψη του αρχείου CSV -->
    <?php if (!empty($data['chart_data'])): ?>
      <p><a href="download.php?id=<?php echo $id; ?>" class="btn">Download CSV file</a></p>
    <?php endif; ?>
    <div id="chart-container"></div>
    <h2>CSV:</h2>
    <pre><?php echo htmlspecialchars(json_encode($data['chart_data'], JSON_PRETTY_PRINT)); ?></pre>

    <script>
      // Δημιουργία του γραφήματος ECharts
      var chartData = <?php echo json_encode($data['chart_data']); ?>;
      var chartContainer = document.getElementById('chart-container');
      var myChart = echarts.init(chartContainer);

      // Ορισμός των δεδομένων για το γράφημα
      var options = {
          tooltip: {
              trigger: 'axis'
          },
          legend: {
              data: chartData.map(series => series.name)
          },
          xAxis: {
              type: 'category',
              data: chartData.length > 0 ? chartData[0].data.map((_, i) => i + 1) : []
          },
          yAxis: {
              type: 'value'
          },
          series: chartData.map(series => ({
              name: series.name,
              type: series.type,
              data: series.data
          }))
      };

      // Εφαρμογή των επιλογών στο γράφημα
      myChart.setOption(options);
    </script>
  <?php else: ?>
    <p>No data found for chart.</p>
  <?php endif; ?>
</body>
</html>
