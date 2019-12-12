<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Institution extends Model
{
    protected $table = 'institutions';

    protected $fillable = [
        'name', 'slug', 'initials', 'presentation', 'city_id',
        'address', 'latitude', 'longitude', 'email', 'website',
        'institution_type_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
