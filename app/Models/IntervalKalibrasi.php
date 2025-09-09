<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervalKalibrasi extends Model
{
    protected $table = 'interval_kalibrasi'; // bukan interval_kalibrasis
    protected $fillable = ['nama_alat', 'interval_bulan'];
}
