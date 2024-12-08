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
            <a href="kucing.html">Konsultasi</a>
            <a href="profil.html">Profil</a>
        </nav>
    </header>

    <div class="form-container">
        <h2>Tunggu dulu, kami ingin tahu tentang kucingmu!</h2>
        <form action="kucing.php" method="POST">
            <label for="name">Nama kucing:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="date">Tanggal konsultasi:</label>
            <input type="date" id="date" name="date" required>
            
            <button type="submit" class="info-btn">Submit</button>
        </form>
    </div>
</body>
</html>
