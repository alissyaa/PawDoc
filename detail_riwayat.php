<?php
session_start();
include('php/conn.php');
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda belum login!'); window.location.href = 'beranda.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa</title>
    <link rel="stylesheet" href="s_r.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"rel="stylesheet">
</head>
<body>
    <header>
        <h2>
            <a href="#" class="logo">
                <img src="assets/logo.png" alt="Logo" class="logo" />
            </a>
        </h2>
        <nav class="navigation">
            <a href="beranda.php">Beranda</a>
            <a href="kucing.php">Konsultasi</a>
            <a href="#">Riwayat</a>
        </nav>
    </header>
    <?php

if (isset($_GET['id_konsultasi'])) {
    $id_konsultasi = $_GET['id_konsultasi'];

    $sql = "SELECT nama_kucing, riwayat_penyakit, tanggal_konsultasi,gejala
                FROM konsultasi 
                WHERE id_konsultasi = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_konsultasi);
        $stmt->execute();
        $stmt->bind_result($nama_kucing, $penyakit, $tanggal_konsultasi, $gejala_json);
        $stmt->fetch();

        if ($nama_kucing) {
            echo "<div class='card'>";
            echo "<p class='date'>" . $tanggal_konsultasi . "</p>";
            echo "<h1 class='title'>" . $nama_kucing . "</h1>";
            echo "<p class='subtitle'>" . $penyakit . "</p>";
            if ($gejala_json) {
                $gejala_array = json_decode($gejala_json, true); 
                echo "Gejala :";
                foreach ($gejala_array as $gejala) {
                    echo "<li>" . $gejala . "</li>";
                }
            } else {
                echo "<p>Tidak ada gejala yang dipilih.</p>";
            }
            echo "</div>";
        } else {
            echo "<p>Data konsultasi tidak ditemukan.</p>";
        }

    }
}
?>


</body>
</html>
