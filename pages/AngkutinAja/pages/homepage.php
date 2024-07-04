<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'warga') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - AngkutinAja</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap">
</head>
<body class="homepage">
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
    <main class="homepage-content">
        <section class="welcome-section">
            <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Ini adalah halaman utama untuk warga. Anda dapat melihat informasi yang relevan di sini.</p>
        </section>
        <section class="data-section">
            <h3>Data Sampah Anda</h3>
            <p>Di sini Anda dapat melihat data pribadi Anda terkait sampah yang Anda kelola.</p>
            <!-- Tambahkan konten data sampah atau informasi lain yang relevan -->
        </section>
    </main>
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
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("open");
        }

        function toggleProfileMenu() {
            document.getElementById("profile-menu").classList.toggle("open");
        }

        document.getElementById("openSidebarBtn").addEventListener("click", toggleSidebar);
        document.getElementById("closeSidebarBtn").addEventListener("click", toggleSidebar);
    </script>
</body>
</html>
