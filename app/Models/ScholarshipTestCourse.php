<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipTestCourse extends Model
{
    //
    
    protected $table="scholarship_test_courses";
    protected $fillable=[
       'course_code',
       'course_name',
       'course_duration',
       'course_fee',
       'course_scholarship_amount',
       'course_subsidized_fee',
       'course_monthly_installment',
    ];
}
