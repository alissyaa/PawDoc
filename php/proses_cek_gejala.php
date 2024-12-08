<?php
session_start();
include('conn.php'); 

$gejalaInput = isset($_POST['gejala']) ? $_POST['gejala'] : [];

if (empty($gejalaInput)) {
    $_SESSION['hasil'] = "Anda Sehat";
    header("Location: ../hasil.php");
    exit();
}

$gejalaQuery = "SELECT * FROM gejala WHERE kode_gejala IN ('" . implode("','", $gejalaInput) . "')";
$gejalaResult = $conn->query($gejalaQuery);

$gejalaTerpilih = [];
while ($row = $gejalaResult->fetch_assoc()) {
    $gejalaTerpilih[$row['kode_gejala']] = [
        'gejala' => $row['gejala'],
        'bobot' => $row['bobot']
    ];
}

$penyakitQuery = "SELECT p.kode_penyakit, p.nama_penyakit, p.solusi, pg.kode_gejala, g.bobot 
                  FROM penyakit p 
                  JOIN penyakit_gejala pg ON p.kode_penyakit = pg.kode_penyakit 
                  JOIN gejala g ON pg.kode_gejala = g.kode_gejala";
$penyakitResult = $conn->query($penyakitQuery);

$penyakitData = [];
while ($row = $penyakitResult->fetch_assoc()) {
    $penyakitData[$row['kode_penyakit']]['nama_penyakit'] = $row['nama_penyakit'];
    $penyakitData[$row['kode_penyakit']]['solusi'] = $row['solusi'];
    $penyakitData[$row['kode_penyakit']]['gejala'][$row['kode_gejala']] = $row['bobot'];
}

$penyakitJarak = [];

foreach ($penyakitData as $kodePenyakit => $dataPenyakit) {
    $nilaiSementara = 0;
    $totalBobotGejala = array_sum($dataPenyakit['gejala']);
    
    foreach ($dataPenyakit['gejala'] as $kodeGejala => $bobot) {
        if (isset($gejalaTerpilih[$kodeGejala])) {
            $nilaiSementara += $bobot * 1;
        } else {
            $nilaiSementara += $bobot * 0.1;
        }
    }
    
    $penyakitJarak[$kodePenyakit] = $nilaiSementara / $totalBobotGejala;
}

asort($penyakitJarak);

$K = 3;
$hasilPenyakit = array_slice($penyakitJarak, 0, $K, true);

if (empty($hasilPenyakit)) {
    $_SESSION['hasil'] = "Anda Sehat";
} else {
    $hasilOutput = "";
    foreach ($hasilPenyakit as $kodePenyakit => $nilai) {
        $hasilOutput .= "<h3>" . $penyakitData[$kodePenyakit]['nama_penyakit'] . "</h3>";
        $hasilOutput .= "<p>Solusi: " . $penyakitData[$kodePenyakit]['solusi'] . "</p><br>";
    }
    $_SESSION['hasil'] = $hasilOutput;
}

header("Location: ../hasil.php");
exit();

?>
