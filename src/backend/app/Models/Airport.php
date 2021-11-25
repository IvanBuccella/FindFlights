<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table      = 'airports';
    protected $primaryKey = 'id';
    protected $fillable   = ['name', 'code', 'lat', 'lng'];

    use HasFactory;
}
