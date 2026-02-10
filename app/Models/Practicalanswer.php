<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practicalanswer extends Model
{
    //

    protected $table="practicalanswers";
    protected $fillable=[
            'practical_id',
            'user_id',
            'student_answer',
            'student_score',
            'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function practical()
    {
        return $this->belongsTo(Practical::class, 'practical_id');
    }
}
