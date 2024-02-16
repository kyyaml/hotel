<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa  extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'nis';

    protected $fillable = [
        'nis',
        'nama',
        'username',
        'password',
    ];

    public function memberEkstra()
    {
        return $this->hasMany(MemberEkstra::class, 'nis', 'nis');
    }

    public function ekstrakurikuler()
    {
        return $this->belongsToMany(Ekstrakurikuler::class, 'member_ekstra', 'nis', 'id_ekstra');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'nis', 'nis');
    }
}
