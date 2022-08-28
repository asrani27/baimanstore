<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';
    protected $guarded = ['id'];

    public function persyaratan()
    {
        return $this->belongsToMany(Persyaratan::class, 'layanan_persyaratan', 'layanan_id', 'persyaratan_id');
    }
}
