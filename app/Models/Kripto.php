<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kripto extends Model
{
    use HasFactory;
    protected $fillable = ['symbol'];
    protected $table = 'table_kriptos';
}
