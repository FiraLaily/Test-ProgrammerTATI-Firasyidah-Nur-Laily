<?php
include 'koneksi.php';

// ID atasan, bisa didapat dari session atau hardcoded
$id_atasan = 123;  // Misalnya, ID atasan (sesuaikan sesuai sistem otentikasi)

$query = "SELECT l.id, p.nama, l.tanggal, l.status
          FROM log_harian l
          JOIN pegawai p ON l.id_pegawai = p.id
          WHERE l.status = 'Menunggu'"; // Status 'Menunggu' untuk log yang belum diverifikasi

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Log Harian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .btn-verify {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-verify:hover {
            background-color: #45a049;
        }

        .status-pending {
            color: orange;
        }

        .status-approved {
            color: green;
        }

        .status-rejected {
            color: red;
        }

        .message {
            font-size: 16px;
            color: green;
            margin-top: 20px;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Verifikasi Log Harian Pegawai</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr id="row-<?= $row['id']; ?>">
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td class="status <?= strtolower($row['status']); ?>"><?= $row['status']; ?></td>
                        <td>
                            <a href="proses_verifikasi.php?id=<?= $row['id']; ?>&status=Disetujui&id_verifikator=<?= $id_atasan ?>">Setujui</a>
                            <a href="proses_verifikasi.php?id=<?= $row['id']; ?>&status=Ditolak&id_verifikator=<?= $id_atasan ?>">Tolak</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada log yang perlu diverifikasi.</p>
    <?php endif; ?>

</div>

</body>
</html>
