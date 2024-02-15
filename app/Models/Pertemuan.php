<?php

namespace App\Models;

use Carbon\Carbon;
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
        'start_time',
        'end_time',
        'id_ekstra'
    ];

    protected $dates = ['start_time', 'end_time'];

    public function formatTime()
    {
        return [
            'start_time' => Carbon::parse($this->start_time)->format('H:i'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i')
        ];
    }


    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'id_ekstra');
    }
}
