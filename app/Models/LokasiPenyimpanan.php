<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPenyimpanan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="lokasi_penyimpanans";
    protected $primaryKey = 'kode';
    public $incrementing = false;

}
