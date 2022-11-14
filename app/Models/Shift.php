<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;
use App\Models\JadwalPelanggan;
use App\Models\JadwalPetugas;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shift';
    protected $primaryKey = 'shift_id';

    protected $fillable = [
        // 'desa_id',
        'shift',
    ];

    public function jadwalPetugas(){
        return $this->hasMany(JadwalPetugas::class) ;
    }
    public function jadwalPelanggan(){
        return $this->hasMany(JadwalPelanggan::class) ;
    }
}
