<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table="questions";
    protected $fillable=[
      'question_name',
      'question_mark',
      'question_answer',
      'exam_id',
      'practical_id',
    ];

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class, 'user_id');
    }
    public function practical(){
        return $this->belongsTo(Practical::class);
    }
}
