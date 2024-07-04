<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include config file
include('../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Warga WHERE id = $id");
    $warga = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_identitas = $_POST['nomor_identitas'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql = "UPDATE Warga SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', nomor_identitas='$nomor_identitas', nomor_telepon='$nomor_telepon' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: data_warga.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="add-data-form">
        <h2>Edit Data Warga</h2>
        <form action="edit_warga.php" method="post">
            <input type="hidden" name="id" value="<?php echo $warga['id']; ?>">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $warga['nama']; ?>" required>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $warga['alamat']; ?>" required>
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Pria" <?php if($warga['jenis_kelamin'] == 'Pria') echo 'selected'; ?>>Pria</option>
                <option value="Wanita" <?php if($warga['jenis_kelamin'] == 'Wanita') echo 'selected'; ?>>Wanita</option>
            </select>
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $warga['tanggal_lahir']; ?>" required>
            <label for="nomor_identitas">Nomor Identitas:</label>
            <input type="text" id="nomor_identitas" name="nomor_identitas" value="<?php echo $warga['nomor_identitas']; ?>" required>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo $warga['nomor_telepon']; ?>" required>
            <button type="submit">Update Data</button>
        </form>
    </div>
</body>
</html>
