<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    use HasFactory;

    protected $table = 'kabupaten_kota';
    protected $primaryKey = 'kabupaten_kota_id';

    protected $fillable = [
        'provinsi_id',
        'nama_kabupaten_kota',

    ];

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class) ;
    }
    public function provinsi(){
        return $this->belongsTo(Provinsi::class,"provinsi_id", "provinsi_id");

    }

}
