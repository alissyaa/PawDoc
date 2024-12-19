<?php
session_start();
$isLoggedIn = isset($_SESSION['id_user']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="styles.css" rel="stylesheet">
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
                <a href="#">Beranda</a>
                <a href="kucing.php">Konsultasi</a>
                <a href="riwayat.php">Riwayat</a>
            </nav>
        </header>

        <div class="content">
            <div class="info">
                <img src="assets/kucing.png" alt="Gambar Kucing" class="kuzing">
                <h2>Hi, paw parents!</h2>
                <p>Dengan langkah sederhana, temukan potensi masalah kesehatan kucingmu<br><span>dan berikan perawatan
                        terbaik untuknya.</span></p>
                <a href="<?= $isLoggedIn ? 'kucing.php' : 'javascript:void(0);' ?>" 
                        class="info-btn" data-logged-in="<?= $isLoggedIn ? 'true' : 'false' ?>">Mulai diagnosa</a>
            </div>
        </div>

    <!-- Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Login</h2>
            <form action="php/loginsignup.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="info-btn">Login</button>
            </form>
            <p class="signup-text">Belum punya akun? <a href="#" id="signupLink">Sign Up</a></p>
        </div>
    </div>

    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close-signup-btn">&times;</span>
            <h2>Sign Up</h2>
            <form action="php/loginsignup.php" method="POST">
                <label for="signupEmail">Email:</label>
                <input type="email" id="signupEmail" name="email" required>
                <label for="signupPassword">Password:</label>
                <input type="password" id="signupPassword" name="password" required>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <button type="submit" class="info-btn">Sign Up</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>