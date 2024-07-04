<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

// Fetch data
$result = $conn->query("SELECT t.id, t.warga_id, t.jumlah, t.tanggal, t.jenis_transaksi, w.nama AS warga_nama FROM Transaksi t JOIN Warga w ON t.warga_id = w.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
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
            <h1>Transaksi</h1>
            <button id="openModalBtn">Tambah Transaksi</button>
        </header>
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Warga ID</th>
                        <th>Jumlah (kg)</th>
                        <th>Tanggal</th>
                        <th>Jenis Transaksi</th>
                        <th>Nama Warga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['warga_id']; ?></td>
                            <td><?php echo $row['jumlah']; ?> kg</td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['jenis_transaksi']; ?></td>
                            <td><?php echo $row['warga_nama']; ?></td>
                            <td>
                                <a href="edit_transaksi.php?id=<?php echo $row['id']; ?>">Edit</a> |
                                <a href="delete_transaksi.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
            <h2>Tambah Transaksi</h2>
            <form action="add_transaksi.php" method="post">
                <label for="warga_id">Nama Warga:</label>
                <select id="warga_id" name="warga_id" required>
                    <?php
                    $wargaResult = $conn->query("SELECT id, nama FROM Warga");
                    while ($wargaRow = $wargaResult->fetch_assoc()) {
                        echo '<option value="' . $wargaRow['id'] . '">' . $wargaRow['nama'] . '</option>';
                    }
                    ?>
                </select>
                <label for="jumlah">Jumlah (kg):</label>
                <input type="number" id="jumlah" name="jumlah" required>
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>
                <label for="jenis_transaksi">Jenis Transaksi:</label>
                <input type="text" id="jenis_transaksi" name="jenis_transaksi" required>
                <button type="submit">Tambah Transaksi</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>

<?php
$conn->close();
?>
