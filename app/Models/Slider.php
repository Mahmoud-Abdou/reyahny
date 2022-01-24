<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $collection = 'sliders';
    protected $fillable=[
        "slider_id",
        "name",
        "title",
        "description",
        "image",
        "lang_code",//['ar','en']
    ];
}
