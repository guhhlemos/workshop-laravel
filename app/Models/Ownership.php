<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ownership extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'cpf'];

    public function getCpfAttribute()
    {
        $cpf = $this->attributes['cpf'];

        return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = str_replace(['.', '-'], '', $value);
    }

    public function getFullnameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    public function drivers_license()
    {
        return $this->hasOne(DriversLicense::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
