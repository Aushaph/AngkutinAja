<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'pengurus') {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

// Fetch data
$result = $conn->query("SELECT s.id, s.jenis, s.berat, s.harga_per_kg, s.tanggal, w.nama AS warga_nama FROM SampahPlastik s JOIN Warga w ON s.warga_id = w.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sampah</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
        }
        .menu-sidebar {
            width: 200px;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 8px;
        }
        .menu-sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .menu-sidebar ul li {
            margin-bottom: 10px;
        }
        .menu-sidebar ul li a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
            border-radius: 4px;
        }
        .menu-sidebar ul li a:hover {
            background-color: #ddd;
        }
        .data-content {
            flex: 1;
            margin-left: 20px;
        }
        .data-table {
            margin-top: 20px;
        }
        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f2f2f2;
        }
        .data-table td {
            background-color: #fff;
        }
    </style>
</head>
<body class="data-page">
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
        <div class="menu-sidebar">
            <ul>
                <li><a href="data.php">Data Sampah</a></li>
                <li><a href="data_warga.php">Data Warga</a></li>
                <li><a href="data_harga.php">Data Harga</a></li>
                <li><a href="data_transaksi.php">Data Transaksi</a></li>
            </ul>
        </div>
        <div class="data-content">
            <header>
                <h1>Data Sampah</h1>
                <button id="openModalBtn">Tambah Data</button>
            </header>
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Sampah</th>
                            <th>Berat (kg)</th>
                            <th>Harga per kg</th>
                            <th>Tanggal</th>
                            <th>Nama Warga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['jenis']; ?></td>
                                <td><?php echo $row['berat']; ?></td>
                                <td><?php echo $row['harga_per_kg']; ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                                <td><?php echo $row['warga_nama']; ?></td>
                                <td>
                                    <a href="edit_data.php?id=<?php echo $row['id']; ?>">Edit</a> |
                                    <a href="delete_data.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Dialog HTML -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Tambah Data Sampah</h2>
            <form action="add_data.php" method="post">
                <label for="jenis">Jenis Sampah:</label>
                <input type="text" id="jenis" name="jenis" required>
                <label for="berat">Berat (kg):</label>
                <input type="number" id="berat" name="berat" required>
                <label for="harga_per_kg">Harga per kg:</label>
                <input type="number" id="harga_per_kg" name="harga_per_kg" required>
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>
                <label for="warga_id">Nama Warga:</label>
                <select id="warga_id" name="warga_id" required>
                    <?php
                    $wargaResult = $conn->query("SELECT id, nama FROM Warga");
                    while ($wargaRow = $wargaResult->fetch_assoc()) {
                        echo '<option value="' . $wargaRow['id'] . '">' . $wargaRow['nama'] . '</option>';
                    }
                    ?>
                </select>
                <button type="submit">Tambah Data</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>
