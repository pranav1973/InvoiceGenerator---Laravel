<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'postcode', 'city', 'state', 'country_id', 'phone', 'email'];

    public function customer_fields()
    {
        return $this->hasMany(CustomerField::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
