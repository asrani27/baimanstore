<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $guarded = ['id'];

    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id');
    }
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
