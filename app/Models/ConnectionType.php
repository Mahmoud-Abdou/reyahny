<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class ConnectionType extends Model
{
    use HasFactory;
    protected $collection = 'connection_types';
    protected $fillable=[
        "connection_type_id",
        "service_id",
        "title",
        "price",
        "image",
        "lang_code",//['ar','en']
    ];

}
