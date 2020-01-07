<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionImage extends Model
{
    protected $fillable = [
        'full', 'thumnail'
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
