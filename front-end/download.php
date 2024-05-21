<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "chart_data";

// Σύνδεση στη βάση δεδομένων
$conn = new mysqli($host, $username, $password, $dbname);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Πάρε το ID από το URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Ερώτημα SQL για να επιλέξετε τα δεδομένα του γραφήματος με βάση το ID
    $sql = "SELECT chart_data FROM charts WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $chart_data = $row['chart_data'];

        if (!empty($chart_data)) {
            // Όνομα αρχείου CSV
            $csv_filename = 'chart_data.csv';

            // Ορισμός του Content-Type και του Content-Disposition για την κατέβασμα του αρχείου CSV
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $csv_filename . '"');

            // Εκτύπωση των δεδομένων ως CSV
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

// Κλείσιμο της σύνδεσης στη βάση δεδομένων
$conn->close();
?>
