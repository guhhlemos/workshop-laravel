<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    use HasFactory;

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = str_replace(['.', '-'], '', $value);
    }

    public function getFullnameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    public function driversLicense()
    {
        return $this->hasOne(DriversLicense::class);
    }
}
