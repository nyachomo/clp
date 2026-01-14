<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practical extends Model
{
    //
    protected $table="practicals";
    protected $fillable=[
           'clas_id',
           'course_id',
           'course_module_id',
           'name',
           'question',
           'marks',
           'status',
           'is_multiple_choice',
    ];

    public function clas(){
        return $this->belongsTo(Clas::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function coursemodule(){
        return $this->belongsTo(CourseModule::class,'course_module_id');
    }

    public function questions(){
        return $this->hasMany(Question::class,'practical_id');
    }
}
