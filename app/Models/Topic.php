<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $table="topics";
    protected $fillable=[
      'topic_name',
      'topic_content',
      'topic_video_link',
      'topic_status',
    ];
}