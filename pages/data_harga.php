<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

// Fetch data
$result = $conn->query("SELECT * FROM HargaSampah");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harga Sampah</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/scripts.js" defer></script>
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
            <h1>Harga Sampah</h1>
            <button id="openModalBtn">Tambah Harga Sampah</button>
        </header>
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis Sampah</th>
                        <th>Harga per kg</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['jenis']; ?></td>
                            <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="edit_harga.php?id=<?php echo $row['id']; ?>">Edit</a> |
                                <a href="delete_harga.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
            <h2>Tambah Harga Sampah</h2>
            <form action="add_harga.php" method="post">
                <label for="jenis">Jenis Sampah:</label>
                <input type="text" id="jenis" name="jenis" required>
                <label for="harga">Harga per kg:</label>
                <input type="number" id="harga" name="harga" required>
                <button type="submit">Tambah Harga</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>
