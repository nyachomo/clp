<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipLetter extends Model
{
    //

    protected $table='scholarship_letters';
    protected $fillable=[
            'form_four',
            'lower_forms',
            'date',
            'letter_id',
            'stamp',
            'signature',
            'start_date',
           'registration_deadline',
            'category',
    ];
}
