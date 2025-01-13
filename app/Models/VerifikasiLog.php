<?php
// app/Models/VerifikasiLog.php
namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiLog extends Model
{
    use HasFactory;

    protected $fillable = ['id_log', 'id_verifikator', 'status_verifikasi'];

    public function log()
    {
        return $this->belongsTo(LogHarian::class, 'id_log');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_verifikator');
    }
}