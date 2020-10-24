<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan_barang_m extends Model
{
    use HasFactory;
    protected $table = 'satuan';
    protected $fillable = ['satuan', 'x', 'y'];
    public $timestamps = false;
}
