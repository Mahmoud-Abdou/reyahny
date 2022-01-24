<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $collection = 'services';
    protected $fillable=[
        "service_id",
        "name",
        "title",
        "description",
        "image",
        "lang_code",//['ar','en']
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
