<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan;
use App\Models\Shift;
use App\Models\Desa;

class JadwalPelanggan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_pelanggan';
    protected $primaryKey = 'jadwal_pelanggan_id';

    protected $fillable = [
        'shift_id',
        'pelanggan_id',
        'desa_id',
        'hari'
    ];

    public function shift(){
        return $this->belongsTo(Shift::class,"shift_id","shift_id") ;
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class,"pelanggan_id","pelanggan_id") ;
    }
    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");
    }
}
