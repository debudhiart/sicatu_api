<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';
    protected $primaryKey = 'desa_id';

    protected $fillable = [
        'nama_desa',
        'kecamatan_id'
    ];


    public function user(){
        return $this->hasMany(User::class) ;
    }
    public function operator(){
        return $this->hasMany(Operator::class) ;
    }
    public function jabatan(){
        return $this->hasMany(Jabatan::class) ;
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
    public function jenisLangganan(){
        return $this->hasMany(JenisLangganan::class) ;
    }
    public function jadwalPetugas(){
        return $this->hasMany(JadwalPetugas::class) ;
    }
    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class,"kecamatan_id", "kecamatan_id");

    }
}
