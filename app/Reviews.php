<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable=[
        'user_id','vendor_id','service_id','rate','feedback'
    ];

    protected $appends=[
        'user_name',
        'vendor_name',
    ];

    public function getUserNameAttribute()
    {
        $user=User::find($this->user_id);
        if($user!=null){
            return $user->name;
        }
        return '_';
    }
    public function getVendorNameAttribute()
    {
        $user=Vendor::find($this->vendor_id);
        if($user!=null){
            return $user->name;
        }
        return '_';
    }
}
