<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    //
    protected $table="clas";
    protected $fillable=[
       'clas_name',
       'clas_status',
       'clas_timetable',
    ];

    public function exams(){
        return $this->hasMany(Exam::class,'clas_id','id');
    }
}
