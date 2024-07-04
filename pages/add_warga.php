<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_identitas = $_POST['nomor_identitas'];
    $nomor_telepon = $_POST['nomor_telepon'];

    $sql = "INSERT INTO Warga (nama, alamat, jenis_kelamin, tanggal_lahir, nomor_identitas, nomor_telepon) 
            VALUES ('$nama', '$alamat', '$jenis_kelamin', '$tanggal_lahir', '$nomor_identitas', '$nomor_telepon')";

    if ($conn->query($sql) === TRUE) {
        header("Location: data.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
