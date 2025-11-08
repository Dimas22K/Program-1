<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmlKania extends Model
{
    use HasFactory;

    protected $table = 'dml_kania'; 
    protected $primaryKey = 'id';   

    public $timestamps = false;
}