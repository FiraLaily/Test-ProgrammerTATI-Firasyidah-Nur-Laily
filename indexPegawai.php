<?php
include 'koneksi.php';

// Mengambil data log pegawai
$query = "SELECT log_harian.id, pegawai.nama AS pegawai, pegawai.jabatan, log_harian.tanggal, log_harian.aktivitas, log_harian.status 
          FROM log_harian 
          JOIN pegawai ON log_harian.id_pegawai = pegawai.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Log Pegawai</title>
    <style>
        /* CSS styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <!-- Memasukkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fungsi untuk memperbarui status menggunakan AJAX
        function updateStatus(id, status) {
            $.ajax({
                url: 'verifikasi_log.php',
                type: 'GET',
                data: { id: id, status: status },
                success: function(response) {
                    // Jika sukses, update status di tabel tanpa reload halaman
                    $("#status-" + id).text(status);
                },
                error: function() {
                    alert('Error: gagal memperbarui status');
                }
            });
        }
    </script>
</head>
<body>

<h2>Data Log Pegawai</h2>
    
<table>
    <tr>
        <th>ID</th>
        <th>Nama Pegawai</th>
        <th>Jabatan</th>
        <th>Tanggal</th>
        <th>Aktivitas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['pegawai'] ?></td>
        <td><?= $row['jabatan'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['aktivitas'] ?></td>
        <td id="status-<?= $row['id'] ?>"><?= $row['status'] ?></td>
        <td>
            <!-- Tautan untuk verifikasi status -->
            <button onclick="updateStatus(<?= $row['id'] ?>, 'Disetujui')">Setujui</button> | 
            <button onclick="updateStatus(<?= $row['id'] ?>, 'Ditolak')">Tolak</button>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
