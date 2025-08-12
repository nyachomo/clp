<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    //

    protected $table='contactus';
    protected $fillable=[
        'fullname',
        'email',
        'subject',
        'phonenumber',
        'message',
    ];
}
