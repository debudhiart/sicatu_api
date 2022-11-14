<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    protected $primaryKey = 'jabatan_id';

    protected $fillable = [
        'desa_id',
        'nama_jabatan',
    ];

    public function operator(){
        return $this->hasMany(Operator::class) ;
    }
    public function desa(){
        return $this->belongsTo(Desa::class,"desa_id", "desa_id");

    }
}
