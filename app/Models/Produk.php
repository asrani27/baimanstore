<?php

namespace App\Models;

use App\Models\Toko;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $guarded = ['id'];
        
    public function toko()
    {
        return $this->belongsTo(Toko::class, 'toko_id');
    }
       
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
