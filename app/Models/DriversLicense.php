<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversLicense extends Model
{
    use HasFactory;

    protected $fillable = ['cnh', 'issue_date', 'expiration_date'];

    public function setIssueDateAttribute($value)
    {
        $this->attributes['issue_date'] = Carbon::parse($value)->format('Y-m-d');
        $this->attributes['expiration_date'] = Carbon::parse($value)->addYears(10)->format('Y-m-d');
    }

    public function getExpirationDateAttribute()
    {
        return Carbon::parse($this->attributes['expiration_date'])->format('Y-m-d');
    }

    public function ownership()
    {
        return $this->belongsTo(Ownership::class);
    }
}
