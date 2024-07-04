<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include '../config.php';

$username = $_SESSION['username'];
$sql = "SELECT role FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role = $row['role'];

if ($role !== 'pengurus') {
    header("Location: index.php"); // Redirect jika bukan pengurus
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard AngkutinAja</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dashboard">
    <header class="landing-header">
        <button id="openSidebarBtn" class="open-sidebar-btn">☰</button> <!-- Tombol sidebar -->
        <div class="logo">
            <h1>AngkutinAja</h1>
        </div>
        <div class="header-right">
            <div class="profile-icon">
                <img id="profileIcon" src="../assets/images/profile.png" alt="Profile">
                <div id="profile-menu" class="profile-menu">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <div class="sidebar" id="sidebar">
         <button id="closeSidebarBtn" class="close-sidebar-btn">×</button> <!-- Tombol close -->
         <ul class="sidebar-menu">
           <li><a href="about.php">About</a></li>
           <li><a href="data.php">Data</a></li>
           <li><a href="dashboard.php">Home</a></li>
           <li><a href="profile.php">Profile</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <h1>Dashboard Data Sampah</h1>
            <input type="text" placeholder="Search our data: type anything">
        </header>
        <div class="stats">
            <div class="stat">
                <p>Jumlah Sampah</p>
                <h3><?php echo number_format(0); ?></h3>
                <p>Pekan lalu ▲ <?php echo number_format(0); ?></p>
            </div>
            <div class="stat">
                <p>Produk</p>
                <h3><?php echo number_format(0); ?></h3>
                <p>~~~</p>
            </div>
            <div class="stat">
                <p>Merek</p>
                <h3><?php echo number_format(0); ?></h3>
                <p>~~~</p>
            </div>
        </div>
        <div class="chart">
            <h3>Total Sampah</h3>
            <canvas id="itemChart"></canvas>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Pengelolaan Sampah. All rights reserved.</p>
        <nav>
            <ul>
                <li><a href="about.php">About</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms</a></li>
            </ul>
        </nav>
    </footer>

    <script src="../assets/js/scripts.js"></script>
</body>
</html>
