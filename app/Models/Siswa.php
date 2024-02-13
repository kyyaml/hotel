<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
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

}

