<?php
session_start();

include('php/conn.php');
$sql = "SHOW COLUMNS FROM data";
$result = $conn->query($sql);

$gejalaList = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gejalaList[] = $row['Field'];
    }
}
array_pop($gejalaList);
?>

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
            <a href="#">Konsultasi</a>
            <a href="profil.php">Profil</a>
        </nav>
    </header>

    <div class="outer-container">
        <div class="container">
            <h1>Cek gejala</h1>
            <p>ketahui apa yang dialami kucing anda dengan memasukkan gejala yang dialami kucing anda.</p>
            <form method="POST" action="php/proses_cek_gejala.php">
                <div class="checkbox-group">
                    <?php foreach ($gejalaList as $gejala): ?>
                        <label>
                            <input type="checkbox" name="gejala[]" value="<?php echo htmlspecialchars($gejala); ?>">
                            <?php echo htmlspecialchars($gejala); ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="info-btn">Periksa Hasil</button>
            </form>
        </div>
    </div>
</body>
</html>
