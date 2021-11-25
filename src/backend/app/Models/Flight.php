<?php

namespace App\Models;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table      = 'flights';
    protected $primaryKey = 'id';
    protected $fillable   = ['price'];

    public function departure()
    {
        return $this->hasOne(Airport::class, 'id', 'code_departure');
    }

    public function arrival()
    {
        return $this->hasOne(Airport::class, 'id', 'code_arrival');
    }

    use HasFactory;
}
