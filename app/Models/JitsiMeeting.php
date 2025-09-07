<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JitsiMeeting extends Model
{
    //

    protected $table="jitsi_meetings";
    protected $fillable=[
        'clas_id',
        'course_id',
        'meeting_name',
        'jwt_link',
        'meeting_status',
    ];


    public function clas(){
        return $this->belongsTo(Clas::class);
    }
}
