<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\Access\Authorizable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;
  

    protected $collection = 'users';
    protected $fillable = [
        'name', 'password', 'role','phone','image','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendNotify($comingMessage, $title)
    {
        $title=$title;
        $user_fsm=$this->fcm;
        $message=$comingMessage;
        $appLogo = "{!! asset('upload/logo.png') !!}";
        $fcm_key="AAAAXLjwio8:APA91bGUUsUlsfwI-Iv3tdxcBtYp82a2Znhwm1lsjW7aJs6hNyxwE8YDh_CquDGVWduBqI0ixbDcMTuH4ucEMi8qf1Mrx0XIxowGLOtrhJSjvxHEpovy39IddcD0quUaUaTVi1qBbDjA";
        $notification = [
            'title'        => $title,
            'body'         => $message,
            'icon'         =>  $appLogo,
            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            'id' => '2',
        ];
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'to' =>$user_fsm,
            'notification' =>$notification,
            'data' =>$notification,
            "content_available" => true
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $fcm_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return 1;
    }
    public function sendNotifyAll($comingMessage, $title, $type)
    {
        $title=$title;
       
        if ($type==1) {
            $user_fsm= "/topics/users_offers";
        } elseif ($type==0) {
            $user_fsm= "/topics/vendors_offers";
        } else {
            $user_fsm= "/topics/offers";
        }
        $message=$comingMessage;
        $appLogo = "{!! asset('upload/logo.png') !!}";
        $fcm_key="AAAAXLjwio8:APA91bGUUsUlsfwI-Iv3tdxcBtYp82a2Znhwm1lsjW7aJs6hNyxwE8YDh_CquDGVWduBqI0ixbDcMTuH4ucEMi8qf1Mrx0XIxowGLOtrhJSjvxHEpovy39IddcD0quUaUaTVi1qBbDjA";
        $notification = [
            'title'        => $title,
            'body'         => $message,
            'icon'         =>  $appLogo,
            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            'id' => '2',
        ];
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'to' =>$user_fsm,
            'notification' =>$notification,
            'data' =>$notification,
            "content_available" => true
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $fcm_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        // dd($result);
        curl_close($ch);
        return 1;
    }

    public function isUser()
    {
        return $this->role=="user"?true:false;
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

   
}
