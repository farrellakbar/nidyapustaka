<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Inventaris extends Model
{
    use HasFactory; 
    
    public $timestamps = false;   

    protected $table="inventaries";
    protected $primaryKey = 'kode';
    //jika pk = string(disabled ai)
    public $incrementing = false;


    public function riwayatPerawatans() 
    {
        return $this->hasMany("App\Models\RiwayatPerawatan","kode_inventaris","kode");
    }
}
