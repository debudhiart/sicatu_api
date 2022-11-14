<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $table = 'operator';
    protected $primaryKey = 'operator_id';

    protected $fillable = [
        'desa_id',
        'users_id',
        'jabatan_id',
        'nama_operator',
        'alamat',
        'hp',
    ];


    public function desa(){
        return $this->belongsTo(Desa::class, "desa_id", "desa_id");

    }
    public function user(){
        return $this->belongsTo(User::class, "users_id", "users_id");

    }
    public function jabatan(){
        return $this->belongsTo(Jabatan::class, "jabatan_id", "jabatan_id");
    }
    public function bayar(){
        return $this->hasMany(Bayar::class) ;
    }

}
