<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/scripts.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
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
            <h1>About</h1>
        </header>
        <div class="content">
            <h2>Tentang Aplikasi Pengelolaan Sampah Plastik</h2>
            <p>
                Aplikasi Pengelolaan Sampah Plastik adalah sebuah platform yang dirancang untuk membantu masyarakat dalam mengelola sampah plastik dengan lebih efektif dan efisien. Aplikasi ini menyediakan berbagai fitur untuk mencatat dan memantau data sampah plastik, harga sampah, serta transaksi yang terkait dengan pengelolaan sampah.
            </p>
            <h3>Fitur Utama:</h3>
            <ul>
                <li><strong>Manajemen Data Sampah:</strong> Mencatat jenis, berat, harga per kg, dan tanggal pengumpulan sampah plastik.</li>
                <li><strong>Manajemen Data Warga:</strong> Menyimpan informasi mengenai warga yang berpartisipasi dalam program pengelolaan sampah.</li>
                <li><strong>Pengelolaan Harga Sampah:</strong> Menetapkan dan memperbarui harga sampah plastik berdasarkan jenisnya.</li>
                <li><strong>Transaksi:</strong> Mencatat transaksi yang dilakukan oleh warga terkait pengelolaan sampah plastik.</li>
                <li><strong>Laporan:</strong> Menghasilkan laporan berkala untuk memantau kinerja pengelolaan sampah plastik.</li>
            </ul>
            <h3>Misi Kami:</h3>
            <p>
                Misi kami adalah untuk menciptakan lingkungan yang lebih bersih dan sehat melalui pengelolaan sampah plastik yang efektif. Kami percaya bahwa dengan kolaborasi dan penggunaan teknologi yang tepat, kita dapat mengurangi dampak negatif sampah plastik terhadap lingkungan.
            </p>
            <h3>Kontak Kami:</h3>
            <p>
                Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, silakan hubungi kami di:
                <ul>
                    <li>Email: </li>
                    <li>Telepon: +62 </li>
                    <li>Alamat: Kawasan Rasuna Epicentrum, Jl. H. R. Rasuna Said No.2 kav c-22, RT.2/RW.5, Karet, Kecamatan Setiabudi, Kuningan, Daerah Khusus Ibukota Jakarta 12940</li>
                </ul>
            </p>
        </div>
    </div>
</body>
</html>
