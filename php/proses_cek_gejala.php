<?php
session_start();
include('conn.php'); 

$gejalaInput = isset($_POST['gejala']) ? $_POST['gejala'] : [];

if (empty($gejalaInput)) {
    $_SESSION['hasil'] = "Anda Sehat";
    header("Location: ../hasil.php");
    exit();
}

$query = "SELECT * FROM data";
$hasil = $conn->query($query);

$data = [];
while ($baris = $hasil->fetch_assoc()) {
    $data[] = $baris;
}

$gejala = array_slice(array_keys($data[0]), 0, -1);

function konversi_gejala($data, $gejala) {
    foreach ($data as &$baris) {
        foreach ($gejala as $g) {
            $baris[$g] = ($baris[$g] === "Yes") ? 1 : 0;
        }
    }
    return $data;
}

$data_terkonversi = konversi_gejala($data, $gejala);

// Fungsi untuk menghitung jarak Euclidean
function jarak_euclidean($a, $b) {
    $jumlah = 0;
    foreach ($a as $key => $value) {
        $jumlah += pow($value - $b[$key], 2);
    }
    return sqrt($jumlah);
}

// Fungsi KNN
function prediksi_knn($data_latih, $data_uji, $k) {
    $jarak = [];
    foreach ($data_latih as $latih) {
        $dist = jarak_euclidean($latih['fitur'], $data_uji);
        $jarak[] = ['jarak' => $dist, 'label' => $latih['label']];
    }

    usort($jarak, function($a, $b) {
        return $a['jarak'] <=> $b['jarak'];
    });

    $tetangga = array_slice($jarak, 0, $k);
    $suara = [];
    foreach ($tetangga as $t) {
        if (!isset($suara[$t['label']])) {
            $suara[$t['label']] = 0;
        }
        $suara[$t['label']] += 1;
    }
    arsort($suara);
    return array_key_first($suara);
}

// Siapkan data latih
$data_latih = [];
foreach ($data_terkonversi as $baris) {
    $fitur = [];
    foreach ($gejala as $g) {
        $fitur[$g] = $baris[$g];
    }
    $data_latih[] = ['fitur' => $fitur, 'label' => $baris['penyakit']];
}

// input pengguna dari form 
$data_pengguna = [];
foreach ($gejala as $g) {
    $data_pengguna[$g] = in_array($g, $_POST['gejala']) ? 1 : 0;
}

// Prediksi penyakit menggunakan KNN
$prediksi = prediksi_knn($data_latih, $data_pengguna, 11);

$id_konsultasi = $_SESSION['id_konsultasi']; 

$sql_update = "UPDATE konsultasi SET riwayat_penyakit = ? WHERE id_konsultasi = ?";
if ($stmt = $conn->prepare($sql_update)) {
    $stmt->bind_param("si", $prediksi, $id_konsultasi); 
    if ($stmt->execute()) {
        header("Location: ../hasil.php");
    } else {
        echo "Gagal memperbarui penyakit.";
    }
}
header("Location: ../hasil.php");
exit();

?>
