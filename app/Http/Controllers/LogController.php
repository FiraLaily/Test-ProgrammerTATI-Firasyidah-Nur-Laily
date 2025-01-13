<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LogController extends Controller
{
    // 1. Menampilkan daftar log (Read)
    public function index()
    {
        $logs = LogHarian::with('pegawai')->paginate(10); // Include pagination
        return view('log.index', compact('logs'));
    }

    // 2. Menampilkan form tambah log (Create)
    public function create()
    {
        $pegawai = Pegawai::all(); // Ambil semua pegawai untuk dropdown
        return view('log.create', compact('pegawai'));
    }

    // 3. Menyimpan data log baru (Store)
    public function store(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id',
            'status' => 'required|string|max:255',
        ]);

        LogHarian::create($request->all()); // Simpan ke database
        return redirect()->route('log.index')->with('success', 'Log berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit log (Edit)
    public function edit($id)
    {
        $log = LogHarian::findOrFail($id); // Cari log berdasarkan ID
        $pegawai = Pegawai::all(); // Ambil semua pegawai untuk dropdown
        return view('log.edit', compact('log', 'pegawai'));
    }

    // 5. Memperbarui log (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id',
            'status' => 'required|string|max:255',
        ]);

        $log = LogHarian::findOrFail($id); // Cari log berdasarkan ID
        $log->update($request->all()); // Update data
        return redirect()->route('log.index')->with('success', 'Log berhasil diperbarui!');
    }

    // 6. Menghapus log (Delete)
    public function destroy($id)
    {
        $log = LogHarian::findOrFail($id);
        $log->delete(); // Hapus log
        return redirect()->route('log.index')->with('success', 'Log berhasil dihapus!');
    }
}
