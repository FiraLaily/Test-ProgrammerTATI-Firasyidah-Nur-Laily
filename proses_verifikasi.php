<?php
include 'koneksi.php';

// ID atasan, bisa didapat dari session atau hardcoded
$id_verifikator = isset($_GET['id_verifikator']) ? $_GET['id_verifikator'] : 123;  // Contoh ID atasan

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Menyaring input untuk mencegah SQL injection
    $id = $conn->real_escape_string($id);
    $status = $conn->real_escape_string($status);

    // Update status di tabel log_harian
    $query_update = $conn->prepare("UPDATE log_harian SET status = ? WHERE id = ?");
    $query_update->bind_param("si", $status, $id);
    if ($query_update->execute()) {
        // Insert ke tabel verifikasi_log
        $query_log = $conn->prepare("INSERT INTO verifikasi_log (id_log, id_verifikator, status_verifikasi) VALUES (?, ?, ?)");
        $query_log->bind_param("iis", $id, $id_verifikator, $status);
        if ($query_log->execute()) {
            echo "Log berhasil diverifikasi.";
        } else {
            echo "Gagal menyimpan verifikasi log.";
        }
    } else {
        echo "Gagal memperbarui status log.";
    }

    $query_update->close();
    $query_log->close();
} else {
    echo "Parameter tidak lengkap.";
}
?>
