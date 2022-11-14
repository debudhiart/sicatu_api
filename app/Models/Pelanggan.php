<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';

    protected $fillable = [
        'users_id',
        'desa_id',
        'jenis_langganan_id',
        'nama_pelanggan',
        'jenis_pelanggan',
        'alamat',
        'hp',
        'lat',
        'lng',
    ];


    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");
    }
    public function user(){
        return $this->belongsTo(User::class, "users_id", "users_id");
    }
    public function jenisLangganan(){
        return $this->belongsTo(JenisLangganan::class, "jenis_langganan_id", "jenis_langganan_id");
    }
    public function keluhan(){
        return $this->hasMany(Keluhan::class) ;
    }
    public function bayar(){
        return $this->hasMany(Bayar::class) ;
    }
    public function jadwalPelanggan(){
        return $this->hasMany(JadwalPelanggan::class) ;
    }
}
