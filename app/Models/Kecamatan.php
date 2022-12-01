<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'kecamatan_id';

    protected $fillable = [
        'kabupaten_kota_id',
        'nama_kecamatan',

    ];

    public function desa(){
        return $this->hasMany(Desa::class, "desa_id","desa_id") ;
    }
    public function kabupatenKota(){
        return $this->belongsTo(KabupatenKota::class,"kabupaten_kota_id", "kabupaten_kota_id");

    }

}
