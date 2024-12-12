<?php 
session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    if (isset($_POST['confirmPassword'])) { // Proses Sign Up
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password !== $confirmPassword) {
            echo "<script>alert('Password dan Confirm Password tidak cocok!');
            window.onload = function() {
                document.getElementById('signupmodal').style.display = 'block';
            }
            </script>";
            exit();
        }

        // Cek apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar!')</script>";
            header("Location: ../beranda.html");
            exit();
        }

        // Hash password dan simpan ke database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: ../beranda.html");
            exit();
        } else {
            header("Location: ../beranda.html");
            exit();
        }
    } else { // Proses Login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Ambil user berdasarkan email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../kucing.php");
            exit();
        } else {
            echo "<script>alert('Email atau password salah!');
            window.location.href = '../beranda.html?show_modal=true';
            </script>";
            exit();
        }
    }
}
?>
