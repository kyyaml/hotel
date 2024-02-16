<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $primaryKey = 'id_absen';

    protected $fillable = [
        'id_pertemuan',
        'nis',
        'time',
        'keterangan',
        'status'
    ];


    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan', 'id_pertemuan');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

}
