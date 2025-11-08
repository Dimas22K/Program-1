<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervalKalibrasi extends Model
{
    protected $table = 'interval_kalibrasi';
    protected $fillable = ['nama_alat', 'interval_bulan'];
    public $timestamps = false; 
}
