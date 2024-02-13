<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelatih extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelatih';

    protected $primaryKey = 'id_pelatih';

    protected $fillable = [
        'id_pelatih',
        'nama',
        'username',
        'password',
        'jenis_pelatih',
        'role',
    ];

    public function ekstrakurikuler()
    {
        return $this->hasOne(Ekstrakurikuler::class, 'id_pelatih', 'id_pelatih');
    }

}
