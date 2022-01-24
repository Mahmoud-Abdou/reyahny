<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $collection = 'videos';
    protected $fillable=[
        "video_id",
        "name",
        "title",
        "video_type", // ['youtube'] 
        "video_type_id",
        "lang_code",//['ar','en']
    ];
}
