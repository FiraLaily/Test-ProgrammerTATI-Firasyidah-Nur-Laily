<?php
function predikat_kinerja($hasil_kerja, $perilaku)
{
    // Matriks penilaian kinerja
    $matrix = [
        'diatas ekspektasi' => [
            'diatas ekspektasi' => 'Sangat Baik',
            'sesuai ekspektasi' => 'Baik',
            'dibawah ekspektasi' => 'Butuh Perbaikan',
            'misconduct' => 'Kurang',
            'sangat kurang' => 'Sangat Kurang',
        ],
        'sesuai ekspektasi' => [
            'diatas ekspektasi' => 'Baik',
            'sesuai ekspektasi' => 'Baik',
            'dibawah ekspektasi' => 'Butuh Perbaikan',
            'misconduct' => 'Kurang',
            'sangat kurang' => 'Sangat Kurang',
        ],
        'dibawah ekspektasi' => [
            'diatas ekspektasi' => 'Butuh Perbaikan',
            'sesuai ekspektasi' => 'Butuh Perbaikan',
            'dibawah ekspektasi' => 'Kurang',
            'misconduct' => 'Kurang',
            'sangat kurang' => 'Sangat Kurang',
        ],
        'misconduct' => [
            'diatas ekspektasi' => 'Kurang',
            'sesuai ekspektasi' => 'Kurang',
            'dibawah ekspektasi' => 'Kurang',
            'misconduct' => 'Sangat Kurang',
            'sangat kurang' => 'Sangat Kurang',
        ],
        'sangat kurang' => [
            'diatas ekspektasi' => 'Sangat Kurang',
            'sesuai ekspektasi' => 'Sangat Kurang',
            'dibawah ekspektasi' => 'Sangat Kurang',
            'misconduct' => 'Sangat Kurang',
            'sangat kurang' => 'Sangat Kurang',
        ],
    ];

    // Validasi input
    if (!isset($matrix[$hasil_kerja]) || !isset($matrix[$hasil_kerja][$perilaku])) {
        return "Input tidak valid. Pastikan hasil kerja dan perilaku sesuai matriks.";
    }

    // Mengembalikan predikat kinerja berdasarkan matriks
    return $matrix[$hasil_kerja][$perilaku];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Kinerja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
            line-height: 1.6;
            margin: 20px;
        }
        .output {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Form Penilaian Kinerja</h2>

<form method="post">
    <label for="hasil_kerja">Hasil Kerja:</label>
    <select name="hasil_kerja" id="hasil_kerja">
        <option value="diatas ekspektasi">Diatas Ekspektasi</option>
        <option value="sesuai ekspektasi">Sesuai Ekspektasi</option>
        <option value="dibawah ekspektasi">Dibawah Ekspektasi</option>
        <option value="misconduct">Misconduct</option>
        <option value="sangat kurang">Sangat Kurang</option>
    </select><br><br>

    <label for="perilaku">Perilaku:</label>
    <select name="perilaku" id="perilaku">
        <option value="diatas ekspektasi">Diatas Ekspektasi</option>
        <option value="sesuai ekspektasi">Sesuai Ekspektasi</option>
        <option value="dibawah ekspektasi">Dibawah Ekspektasi</option>
        <option value="misconduct">Misconduct</option>
        <option value="sangat kurang">Sangat Kurang</option>
    </select><br><br>

    <input type="submit" value="Tampilkan Predikat Kinerja">
</form>

<?php
// Mengecek jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data input
    $hasil_kerja = $_POST['hasil_kerja'];
    $perilaku = $_POST['perilaku'];

    // Menampilkan hasil predikat kinerja
    $predikat = predikat_kinerja($hasil_kerja, $perilaku);
    echo "<div class='output'>Predikat Kinerja: $predikat</div>";
}
?>

</body>
</html>
