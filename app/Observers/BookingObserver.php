<?php

namespace App\Observers;

use App\Booking;
use App\Vendor;
use Carbon\Carbon;
class BookingObserver
{
    public function retrieved(Booking $Booking)
    {
        $today= Carbon::today()->toDateString();
        date_default_timezone_set("Africa/Cairo");
        $persianDate = new \DateTime(Carbon::now()->toDateTimeString());
        $persianDate = $persianDate->format('Y-m-d H:i');
        
        $array=explode(' ', $persianDate);
        $vendor=Vendor::where('id',$Booking->vendor_id)->first();
        if($vendor!=null){

            if($vendor->type_queue==0){
                if($Booking->date < $today && $Booking->status==0){
    
                    $Booking->status=3;
                    $Booking->save();
                }
            }
            else{
                if($Booking->date == $today && $Booking->status==0 ){
                    if($Booking->time<$array[1]){
                        $Booking->status=3;
                        $Booking->save();
                    }
                }
                else if($Booking->date < $today && $Booking->status==0){
                    $Booking->status=3;
                    $Booking->save();
                }
               
            }
        }
       
    }
    
}
