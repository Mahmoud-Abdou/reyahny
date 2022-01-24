<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $appends=[
        "user_name",
    ];

    public function getUserNameAttribute()
    {
        
        $user=User::where('id',$this->user_id)->first();
        if($user!=null){
            return $user->name .' | '. $user->phone;
        }
           
        return "_";
    }

}
