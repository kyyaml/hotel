<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';

    protected $primaryKey = 'id_ekstra';

    protected $fillable = [
        'id_ekstra',
        'nama',
        'id_pelatih',
    ];

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'id_pelatih', 'id_pelatih');
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'id_ekstra');
    }

    // Relasi dengan model MemberEkstra
    public function memberEkstra()
    {
        return $this->hasMany(MemberEkstra::class, 'id_ekstra', 'id_ekstra');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'member_ekstra', 'id_ekstra', 'nis');
    }
}
