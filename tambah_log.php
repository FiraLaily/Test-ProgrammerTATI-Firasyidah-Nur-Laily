<?php
// Menghubungkan ke database melalui file koneksi.php
include 'koneksi.php'; // Pastikan file koneksi.php ada di lokasi yang benar

// Mengecek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $id_pegawai = $_POST['id_pegawai'];
    $tanggal = $_POST['tanggal'];
    $aktivitas = $_POST['aktivitas'];

    // Menyusun query untuk memasukkan data log harian ke dalam tabel
    $query = "INSERT INTO log_harian (id_pegawai, tanggal, aktivitas) VALUES ('$id_pegawai', '$tanggal', '$aktivitas')";

    // Menjalankan query dan memberikan feedback jika berhasil atau gagal
    if ($conn->query($query)) {
        echo "<p class='message'>Log berhasil ditambahkan.</p>";
    } else {
        echo "Error: " . $conn->error; // Menampilkan pesan error jika query gagal
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Log Harian</title>
    <style>
        /* CSS untuk memperbaiki tampilan form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        select, input[type="date"], textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .message {
            font-size: 16px;
            color: green;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Tambah Log Harian</h2>
    
    <!-- Form untuk menambah log -->
    <form method="post">
        <label for="id_pegawai">Pegawai:</label>
        <select name="id_pegawai" required>
            <?php
            // Mengambil data pegawai dari database untuk ditampilkan dalam dropdown
            $pegawai = $conn->query("SELECT id, nama, jabatan FROM pegawai");

            // Cek jika query berhasil
            if (!$pegawai) {
                die("Error dalam query: " . $conn->error);
            }

            // Periksa apakah ada data pegawai
            if ($pegawai->num_rows > 0) {
                // Menampilkan opsi pegawai dalam dropdown
                while ($row = $pegawai->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nama']} ({$row['jabatan']})</option>";
                }
            } else {
                // Jika tidak ada pegawai, tampilkan pesan
                echo "<option disabled>Tidak ada data pegawai</option>";
            }
            ?>
        </select>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" required>

        <label for="aktivitas">Aktivitas:</label>
        <textarea name="aktivitas" required></textarea>

        <button type="submit">Tambah</button>
    </form>
</body>
</html>
