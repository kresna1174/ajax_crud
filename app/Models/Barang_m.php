<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_m extends Model
{
    use HasFactory;
    protected $table = 'laravel';
    protected $fillable = ['nama_barang', 'satuan'];
    public $timestamps = false;
}
