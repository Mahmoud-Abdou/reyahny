<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $collection = 'products';
    protected $fillable=[
        "product_id",
        "service_id",
        "name",
        "description",
        "image",
        "price",
        "lang_code",//['ar','en']
    ];

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
