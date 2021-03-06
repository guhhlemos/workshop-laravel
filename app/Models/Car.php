<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['manufacturer', 'model', 'model_year', 'ownership_id'];

    public function ownership()
    {
        return $this->belongsTo(Ownership::class);
    }
}
