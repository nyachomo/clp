<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseNote extends Model
{
    protected $table = 'course_notes';

    protected $fillable = [
        'course_id',
        'name',
        'file',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
