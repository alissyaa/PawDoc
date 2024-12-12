<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['id_user'];
    $nama_kucing = $_POST['name'];

    $sql = "INSERT INTO konsultasi (id_user, nama_kucing) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("is", $id_user, $nama_kucing);
        if ($stmt->execute()) {
            $_SESSION['id_konsultasi'] = $stmt->insert_id;
            header("Location: ../konsultasi.php");
        } else {
            echo "Gagal menyimpan data konsultasi: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Gagal mempersiapkan statement: " . $conn->error;
    }
}
?>