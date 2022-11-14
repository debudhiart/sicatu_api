<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLangganan extends Model
{
    use HasFactory;
    protected $table = 'jenis_langganan';
    protected $primaryKey = 'jenis_langganan_id';

    protected $fillable = [
        'desa_id',
        'nama_jenis_langganan',
        'harga',
    ];

    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");

    }
    public function pelanggan(){
        return $this->hasMany(Pelanggan::class) ;
    }
}
