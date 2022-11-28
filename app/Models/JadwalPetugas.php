<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;
use App\Models\Petugas;
use App\Models\Shift;

class JadwalPetugas extends Model
{
    use HasFactory;
    protected $table = 'jadwal_petugas';
    protected $primaryKey = 'jadwal_petugas_id';

    protected $fillable = [
        'shift_id',
        'petugas_id',
        'desa_id',
        'hari'
    ];

    public function petugas(){
        return $this->belongsTo(Petugas::class,"petugas_id","petugas_id") ;
    }
    public function shift(){
        return $this->belongsTo(Shift::class,"shift_id","shift_id") ;
    }
    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");
    }
}
