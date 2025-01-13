const express = require('express');
const router = express.Router();
const mysql = require('mysql');

// Koneksi ke database
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'fira~~',
    database: 'provinsi_db'
});

// Test koneksi
db.connect((err) => {
    if (err) {
        console.error('Koneksi database gagal:', err.message);
    } else {
        console.log('Terhubung ke database');
    }
});

// Handler untuk GET menampilkan daftar provinsi
router.get('/', (req, res) => {
    const query = 'SELECT * FROM provinsi';
    db.query(query, (err, results) => {
        if (err) {
            console.error('Error saat mengambil data:', err.message);
            res.status(500).json({ error: 'Kesalahan server saat mengambil data' });
        } else {
            res.status(200).json({
                success: true,
                data: results,
            });
        }
    });
});

// Handler untuk GET menampilkan detail provinsi berdasarkan ID
router.get('/:id', (req, res) => {
    const { id } = req.params;
    const query = 'SELECT * FROM provinsi WHERE id = ?';
    db.query(query, [id], (err, results) => {
        if (err) {
            console.error('Error saat mengambil data:', err.message);
            res.status(500).json({ error: 'Kesalahan server saat mengambil data' });
        } else if (results.length === 0) {
            res.status(404).json({ error: 'Provinsi tidak ditemukan' });
        } else {
            res.status(200).json({
                success: true,
                data: results[0],
            });
        }
    });
});

// Handler untuk POST menambahkan provinsi baru
router.post('/', (req, res) => {
    const { id, nama, ibu_kota, jumlah_penduduk } = req.body;

    // Validasi input
    if (!id || !nama || !ibu_kota || !jumlah_penduduk) {
        return res.status(400).json({ error: 'Semua data harus diisi' });
    }

    const query = 'INSERT INTO provinsi (id, nama, ibu_kota, jumlah_penduduk) VALUES (?, ?, ?, ?)';
    db.query(query, [id, nama, ibu_kota, jumlah_penduduk], (err, result) => {
        if (err) {
            console.error('Error saat menambahkan data:', err.message);
            res.status(500).json({ error: 'Kesalahan server saat menambahkan data' });
        } else {
            res.status(201).json({
                success: true,
                message: 'Provinsi berhasil ditambahkan',
                data: {
                    id,
                    nama,
                    ibu_kota,
                    jumlah_penduduk,
                },
            });
        }
    });
});

// Handler untuk PUT mengupdate provinsi berdasarkan ID
router.put('/:id', (req, res) => {
    const { id } = req.params;
    const { nama, ibu_kota, jumlah_penduduk } = req.body;

    if (!nama || !ibu_kota || !jumlah_penduduk) {
        return res.status(400).json({ error: 'Semua data harus diisi' });
    }

    const query = 'UPDATE provinsi SET nama = ?, ibu_kota = ?, jumlah_penduduk = ? WHERE id = ?';
    db.query(query, [nama, ibu_kota, jumlah_penduduk, id], (err, result) => {
        if (err) {
            console.error('Error saat mengupdate data:', err.message);
            res.status(500).json({ error: 'Kesalahan server saat mengupdate data' });
        } else if (result.affectedRows === 0) {
            res.status(404).json({ error: 'Provinsi tidak ditemukan' });
        } else {
            res.status(200).json({
                success: true,
                message: 'Provinsi berhasil diperbarui',
            });
        }
    });
});

// Handler untuk DELETE menghapus provinsi berdasarkan ID
router.delete('/:id', (req, res) => {
    const { id } = req.params;
    const query = 'DELETE FROM provinsi WHERE id = ?';
    db.query(query, [id], (err, result) => {
        if (err) {
            console.error('Error saat menghapus data:', err.message);
            res.status(500).json({ error: 'Kesalahan server saat menghapus data' });
        } else if (result.affectedRows === 0) {
            res.status(404).json({ error: 'Provinsi tidak ditemukan' });
        } else {
            res.status(200).json({
                success: true,
                message: 'Provinsi berhasil dihapus',
            });
        }
    });
});

module.exports = router;
