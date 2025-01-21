<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
    protected $table="fees";
    protected $fillable=[
       'user_id',
       'amount_paid',
       'date_paid',
       'payment_method',
       'payment_ref_no',
    ];
}
