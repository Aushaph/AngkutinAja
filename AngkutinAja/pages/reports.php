<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

// Fetch data for report (example)
$result = $conn->query("SELECT * FROM Transaksi");

// Example data for visualization
$data = array(
    array("Month", "Total Transactions"),
    array("January", 20),
    array("February", 30),
    array("March", 25),
    array("April", 35)
);

// Function to export data based on selected format
function exportData($format) {
    // Example logic to export data based on selected format
    if ($format == 'excel') {
        // Export to Excel (XLSX)
        exportToExcel();
    } elseif ($format == 'pdf') {
        // Export to PDF
        exportToPDF();
    }
}

// Function to export to Excel (XLSX)
function exportToExcel() {
    // Code for exporting to Excel (XLSX) goes here
    // Example: use PHPExcel or other libraries
    // For demonstration purposes, this function is left blank
}

// Function to export to PDF
function exportToPDF() {
    // Code for exporting to PDF goes here
    // Example: use TCPDF, FPDF, or other libraries
    // For demonstration purposes, this function is left blank
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/scripts.js" defer></script>
    <!-- Required Libraries for Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

            var options = {
                title: 'Total Transaksi Tiap Bulan',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }

        // Function to handle export based on selected format
        function exportData() {
            var format = document.getElementById('exportFormat').value;
            window.location = 'export_data.php?format=' + format;
        }
    </script>
</head>
<body class="data-page">
    <div class="sidebar">
        <h2>Jakarta, Indonesia</h2>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li class="has-submenu">
                    <a href="javascript:void(0);" class="submenu-toggle" id="toggle-data">Data</a>
                    <ul class="submenu" id="submenu-data">
                        <li><a href="data_warga.php">Data Warga</a></li>
                        <li><a href="data.php">Data Sampah</a></li>
                        <li><a href="data_harga.php">Harga Sampah</a></li>
                        <li><a href="data_transaksi.php">Transaksi</a></li>
                    </ul>
                </li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <h1>Reports</h1>
        </header>
        <div class="report-content">
            <div id="chart_div" style="width: 100%; height: 400px;"></div>
            <div class="table-container">
                <h2>Transaction Report</h2>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Warga ID</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Jenis Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['warga_id']; ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                                <td><?php echo $row['jenis_transaksi']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="export-options">
                    <label for="exportFormat">Export Format:</label>
                    <select id="exportFormat">
                        <option value="excel">Excel (XLSX)</option>
                        <option value="pdf">PDF</option>
                    </select>
                    <button onclick="exportData()">Export</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
