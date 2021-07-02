<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','dosis','fecha_caducidad','tipo'];

    public function pets ()
    {
        return $this->belongsToMany(Pet::class);
    }
}
