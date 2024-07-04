<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $warga_id = $_POST['warga_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $jenis_transaksi = $_POST['jenis_transaksi'];

    $sql = "INSERT INTO Transaksi (warga_id, jumlah, tanggal, jenis_transaksi) VALUES ('$warga_id', '$jumlah', '$tanggal', '$jenis_transaksi')";

    if ($conn->query($sql) === TRUE) {
        header("Location: data_transaksi.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
