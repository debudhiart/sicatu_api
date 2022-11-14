<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;
    protected $table = 'bayar';
    protected $primaryKey = 'bayar_id';

    protected $fillable = [
        'desa_id',
        'pelanggan_id',
        'operator_id',
        'tanggal',
        'nominal'
    ];

    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");
    }
    public function operator(){
        return $this->belongsTo(Operator::class, "operator_id", "operator_id") ;
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, "pelanggan_id", "pelanggan_id") ;
    }
}
