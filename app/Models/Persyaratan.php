<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    use HasFactory;
    protected $table = 'persyaratan';
    protected $guarded = ['id'];

    public function layanan()
    {
        return $this->belongsToMany(Layanan::class, 'layanan_persyaratan', 'layanan_id','persyaratan_id');
    }
}
