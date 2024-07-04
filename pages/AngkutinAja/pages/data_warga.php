<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

// Fetch data
$result = $conn->query("SELECT * FROM Warga");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/scripts.js" defer></script>
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
    
    <div class="main-content">
        <div class="menu-sidebar">
            <ul>
                <li><a href="data_warga.php">Data Warga</a></li>
                <li><a href="data.php">Data Sampah</a></li>
                <li><a href="data_harga.php">Harga Sampah</a></li>
                <li><a href="data_transaksi.php">Transaksi</a></li>
            </ul>
        </div>
        
        <div class="data-content">
            <header>
                <h1>Data Warga</h1>
                <button id="openModalBtn">Tambah Data</button>
            </header>
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor Identitas</th>
                            <th>Nomor Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td><?php echo $row['jenis_kelamin']; ?></td>
                                <td><?php echo $row['tanggal_lahir']; ?></td>
                                <td><?php echo $row['nomor_identitas']; ?></td>
                                <td><?php echo $row['nomor_telepon']; ?></td>
                                <td>
                                    <a href="edit_warga.php?id=<?php echo $row['id']; ?>">Edit</a> |
                                    <a href="delete_warga.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal Dialog HTML -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" id="closeModalBtn">&times;</span>
                <h2>Tambah Data Warga</h2>
                <form action="add_warga.php" method="post">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required>
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                    <label for="nomor_identitas">Nomor Identitas:</label>
                    <input type="text" id="nomor_identitas" name="nomor_identitas" required>
                    <label for="nomor_telepon">Nomor Telepon:</label>
                    <input type="text" id="nomor_telepon" name="nomor_telepon" required>
                    <button type="submit">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>
