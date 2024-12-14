<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="profil.php">Profil</a>
        </nav>
    </header>
    <?php
        session_start();
        include('php/conn.php');
        $id_konsultasi = $_SESSION['id_konsultasi'];

        $sql = "SELECT riwayat_penyakit,nama_kucing FROM konsultasi WHERE id_konsultasi = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id_konsultasi);
            $stmt->execute();
            $stmt->bind_result($penyakit,$nama_kucing);
            $stmt->fetch();

            if ($penyakit) {
                echo "<h2 style='text-align:center;'>Penyakit yang diprediksi: " . htmlspecialchars($penyakit)."</h2>";
                echo "<h2 style='text-align:center;'>Segera bawa ".htmlspecialchars($nama_kucing)." ke dokter hewan!</h2>";
            } else {
                echo  htmlspecialchars($nama_kucing)." Sehat!";
            }
        }
        ?>

</body>
</html>
