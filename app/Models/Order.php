<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $collection = 'orders';
    protected $fillable=[
        "order_id",
        "service_id",
        "user_id",
        "status",
        "connection_type_id",
        "number_of_connections",
        "number_of_residents",
        "products_price",
        "vat_price",
        "total_price",
        "delivery_price",
        "grant_total_price",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasOne(Detail::class);
    }

    public function service()
    {
        return $this->hasOne(Service::class);
    }
    public function bill_images()
    {
        return $this->hasMany(BillImage::class);
    }


}
