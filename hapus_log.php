<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM log_harian WHERE id = $id";
    if ($conn->query($query)) {
        echo "Log berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>