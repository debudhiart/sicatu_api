<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;
    protected $table = 'keluhan';
    protected $primaryKey = 'keluhan_id';

    protected $fillable = [
        'desa_id',
        'pelanggan_id',
        'keluhan',
        'respon',
        'status_keluhan',
        'before_photo',
        'after_photo',
        'lat',
        'lng',
    ];

    public function petugas(){
        return $this->hasMany(Petugas::class) ;
    }
    public function shift(){
        return $this->hasMany(Shift::class) ;
    }
    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, "pelanggan_id", "pelanggan_id");
    }
}
