<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';

    protected $primaryKey = 'id_pertemuan';

    protected $fillable = [
        'id_pertemuan',
        'judul_pertemuan',
        'kegiatan',
        'id_ekstra',
        'tgl_pertemuan'
    ];

    protected $dates = ['tgl_pertemuan'];

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'id_ekstra');
    }
}
