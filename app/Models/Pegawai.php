<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = ['id_log', 'id_verifikator', 'status_verifikasi'];

    public function log()
    {
        return $this->belongsTo(Pegawai::class, 'id_log');
    }

    public function verifikator()
    {
        return $this->belongsTo(Pegawai::class, 'id_verifikator');
    }
}
