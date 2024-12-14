<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa</title>
    <link href="styles.css" rel="stylesheet">
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
            <a href="beranda.html">Beranda</a>
            <a href="kucing.php">Konsultasi</a>
            <a href="#">Riwayat</a>
        </nav>
    </header>
    <?php
        session_start();
        include('php/conn.php');
        $id_user = $_SESSION['id_user'];

        $sql = "SELECT riwayat_penyakit, nama_kucing, tanggal_konsultasi FROM konsultasi WHERE id_user = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id_user); 
            $stmt->execute();
            $stmt->bind_result($penyakit, $nama_kucing, $tanggal_konsultasi);

            if ($stmt->fetch()) {
                echo "<h2 style='text-align:center;'>Riwayat Konsultasi Kucing Anda:</h2>";
                do {
                    echo "<p>Nama Kucing: " . htmlspecialchars($nama_kucing) . "<br>";
                    echo "Penyakit yang Diprediksi: " . htmlspecialchars($penyakit) . "<br>";
                    echo "Tanggal Konsultasi: " . htmlspecialchars($tanggal_konsultasi) . "</p><hr>";
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