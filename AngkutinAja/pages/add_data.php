<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include config file
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST['jenis'];
    $berat = $_POST['berat'];
    $harga_per_kg = $_POST['harga_per_kg'];
    $tanggal = $_POST['tanggal'];
    $warga_id = $_POST['warga_id'];

    $sql = "INSERT INTO SampahPlastik (jenis, berat, harga_per_kg, tanggal, warga_id) VALUES ('$jenis', '$berat', '$harga_per_kg', '$tanggal', '$warga_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: data.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

