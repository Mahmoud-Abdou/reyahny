<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class BillImage extends Model
{
    use HasFactory;
    protected $collection = 'bill_images';
    protected $fillable=[
        "bill_image_id",
        "bill_price",
        "bill_date",
        "image",
        "user_id",
        "cart_id",
        "order_id",
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
