<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practical extends Model
{
    //
    protected $table="practicals";
    protected $fillable=[
           'clas_id',
           'name',
           'question',
           'marks',
           'status',
    ];

    public function clas(){
        return $this->belongsTo(Clas::class);
    }
}
