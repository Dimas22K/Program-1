<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmlKania extends Model
{
    use HasFactory;

    protected $table = 'dml_kania'; // nama tabel di database
    protected $primaryKey = 'id';   // kolom primary key (default id)

    // kalau tidak pakai created_at & updated_at
    public $timestamps = false;
}