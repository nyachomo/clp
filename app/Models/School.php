<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $table="schools";
    protected $fillable=[
       'school_name',
       'school_location',
       'school_status',
    ];
}
