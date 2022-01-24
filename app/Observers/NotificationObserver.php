<?php

namespace App\Observers;

use App\Notification;
use App\User;
use DB;
class NotificationObserver
{
    /**
     * Handle the  notification "created" event.
     *
     * @param  \App\Notification  $Notification
     * @return void
     */
    public function Creating(Notification $Notification)
    {
        $user=User::where('id',$Notification->user_id)->first();
        if($user!=null){
            $user->has_notif=1;
            $user->save();
        }
        else if($Notification->user_id=="-1"||$Notification->user_id=="-3"){
            // dd(023);
            DB::table('users')
                    ->where('role', 'user')
                    ->update(['has_notif'=>'1']);
        }
        
    }

    /**
     * Handle the  notification "updated" event.
     *
     * @param  \App\Notification  $Notification
     * @return void
     */
    public function retrieved(Notification $Notification)
    {
        // dd(0);
        $user=User::where('id',$Notification->user_id)->first();
        if($user!=null){
            // dd(0);
            $user->has_notif=0;
            $user->save();
        }
        else if($Notification->user_id=="-1"||$Notification->user_id=="-3"){
            // dd(023);
            DB::table('users')
                    ->where('role', 'user')
                    ->update(['has_notif'=>'0']);
        }
    }

    }
