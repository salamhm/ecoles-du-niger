<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionContact extends Model
{
    protected $table = 'institution_contacts';

    protected $fillable = ['institution_id', 'number'];
}
