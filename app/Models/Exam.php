<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $table="exams";

    protected $fillable=[
        'exam_type',
        'is_assignment',
        'is_cat',
        'is_final_exam',
        'exam_name',
        'exam_start_date',
        'exam_end_date',
        'exam_duration',
        'exam_instruction',
        'exam_status',
        'is_published',
        'course_id',
        'clas_id'
    ];

    public function clas(){
        return $this->belongsTo(Clas::class,'clas_id');
    }
}
