<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Pastikan $_SESSION['fullname'] ada sebelum digunakan
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Nama Pengguna'; // Ganti 'Nama Pengguna' dengan nilai default yang sesuai
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - AngkutinAja</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="dashboard">
    <header class="landing-header">
        <button id="openSidebarBtn" class="open-sidebar-btn">☰</button> <!-- Tombol sidebar -->
        <div class="logo">
            <h1>AngkutinAja</h1>
        </div>
        <div class="header-right">
            <div class="profile-icon">
                <img id="profileIcon" src="<?php echo $profile_picture; ?>" alt="Profile">
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
            <h1>Profile <?php echo $fullname; ?></h1>
        </header>
        <div class="profile-info">
            <!-- Tampilkan informasi profil pengguna di sini -->
            <p>Username: <?php echo $_SESSION['username']; ?></p>
            <p>Email: <?php echo $_SESSION['email']; ?></p>
            <p>Fullname: <?php echo $fullname; ?></p>
            <!-- Tambahkan form atau informasi lainnya sesuai kebutuhan -->
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
