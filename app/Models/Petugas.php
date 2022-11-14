<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;
use App\Models\User;
use App\Models\JadwalPetugas;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $primaryKey = 'petugas_id';

    protected $fillable = [
        'users_id',
        'desa_id',
        'nama_petugas',
        'alamat',
        'hp',
    ];


    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");

    }
    public function user(){
        return $this->belongsTo(User::class, "users_id", "users_id");

    }
    public function jadwalPetugas(){
        return $this->hasMany(JadwalPetugas::class) ;
    }
}
