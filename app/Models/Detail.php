<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $collection = 'details';
    protected $fillable=[
        "detail_id",
        "user_id",
        "country_name",
        "country_code",
        "address",
        "location_lat",
        "location_long",
        "currancy",
        "phone",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
