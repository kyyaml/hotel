<?php

namespace App\Models;

use Carbon\Carbon;
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
        'status',
        'created_at'
    ];

    protected $dates = ['time'];
    public $timestamps = false;


    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'id_pertemuan', 'id_pertemuan');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

   
    public function formatTime()
    {
        return [
            'time' => Carbon::parse($this->time)->format('H:i'),
        ];
    }

}
