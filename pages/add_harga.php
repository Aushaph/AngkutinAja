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
    $harga = $_POST['harga'];

    $sql = "INSERT INTO HargaSampah (jenis, harga) VALUES ('$jenis', '$harga')";

    if ($conn->query($sql) === TRUE) {
        header("Location: data_harga.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
