<?php
session_start();
include('php/conn.php');
$id_konsultasi = $_SESSION['id_konsultasi'];

// Inisialisasi variabel kosong
$nama_kucing = "";
$penyakit = "";
$keterangan = "";

// Ambil data dari database
$sql = "SELECT riwayat_penyakit, nama_kucing, tanggal_konsultasi FROM konsultasi WHERE id_konsultasi = ?";
if ($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("i", $id_konsultasi);
  $stmt->execute();
  $stmt->bind_result($penyakit, $nama_kucing, $tanggal_konsultasi);
  $stmt->fetch();

  // Logika menentukan keterangan
  if ($penyakit) {
    $keterangan = "Segera bawa " . htmlspecialchars($nama_kucing) . " ke dokter hewan untuk pemeriksaan lebih lanjut.";
  } else {
    $penyakit = "Sehat";
    $keterangan = htmlspecialchars($nama_kucing) . " dalam kondisi sehat. Tetap jaga kesehatannya!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PawDoc Care</title>
  <link rel="stylesheet" href="style.css">
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
      <a href="beranda.html">Beranda</a>
      <a href="kucing.php">Konsultasi</a>
      <a href="riwayatc.php">Riwayat</a>
    </nav>
  </header>
  <div class="container">
    <div class="header">
      <div class="logo">
        <div class="image-title">
          <img src="assets/judul.png" alt="Cat Icon">
        </div>
      </div>
      <h1>PawDoc Care.</h1>
    </div>
    <div class="form-container">
      <form>
        <div class="form-inline">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" value="<?php echo htmlspecialchars($nama_kucing); ?>" readonly>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" value="<?php echo htmlspecialchars($tanggal_konsultasi); ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="penyakit">Penyakit</label>
          <input type="text" id="penyakit" value="<?php echo htmlspecialchars($penyakit); ?>" readonly>
        </div>
      </form>
      <div class="image-box">
        <img src="assets/futu.png" alt="Cat Icon">
      </div>
    </div>
    <div class="form-group full-width">
      <label for="keterangan">Keterangan</label>
      <textarea id="keterangan" readonly><?php echo htmlspecialchars($keterangan); ?></textarea>
    </div>
  </div>
</body>

</html>