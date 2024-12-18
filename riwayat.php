<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Anda belum login!'); window.location.href = 'beranda.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Card</title>
    <link rel="stylesheet" href="s_r.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
    rel="stylesheet">
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
    include('php/conn.php');
    $id_user = $_SESSION['id_user'];

    $sql = "SELECT id_konsultasi,riwayat_penyakit, nama_kucing, tanggal_konsultasi
                FROM konsultasi 
                WHERE id_user = ?
            ORDER BY id_konsultasi DESC";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $stmt->bind_result($id_konsultasi,$penyakit, $nama_kucing, $tanggal_konsultasi);

        if ($stmt->fetch()) {
            echo "<h2 style='text-align:center;'>Riwayat Konsultasi Kucing Anda:</h2>";
            do {
                echo "<div class='card'>";
                echo "<p class='date'>" . $tanggal_konsultasi . "</p>";
                echo "<h1 class='title'>" . $nama_kucing . "</h1>";
                echo "<p class='subtitle'>" . $penyakit . "</p>";
                echo "<a href='detail_riwayat.php?id_konsultasi=" . $id_konsultasi . "' class='detail-button'>Detail</a>";
                echo "</div>";
            } while ($stmt->fetch());
        } else {
            echo "<h2 style='text-align:center;'>Tidak ada riwayat konsultasi.</h2>";
        }
    } else {
        echo "Terjadi kesalahan dalam pengambilan data.";
    }
    ?>
</body>

</html>