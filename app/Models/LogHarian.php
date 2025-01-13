<?php
// app/Models/LogHarian.php
namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHarian extends Model
{
    use HasFactory;

    protected $fillable = ['id_pegawai', 'status'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function verifikator()
    {
        return $this->hasMany(VerifikasiLog::class, 'id_log');
    }
}
