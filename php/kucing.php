<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kucing = $_POST['name'];
    $tanggal_konsultasi = $_POST['date'];

    $sql = "INSERT INTO konsultasi (nama_kucing, tanggal_konsultasi) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $nama_kucing, $tanggal_konsultasi);
        if ($stmt->execute()) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}
?>