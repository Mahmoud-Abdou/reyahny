<?php

namespace App\Http\Controllers;

use Validator;
use App\Reviews;
use Illuminate\Http\Request;
use App;
use App\User;
use App\Booking;
use App\Notification;
class ReviewsController extends Controller
{
    public function set_lang()
    {
        switch (request()->header('language')) {
            case 'en':
                $this->language_code = 1;
                $this->lang = "en";
                break;
            case 'ar':
                $this->language_code = 2;
                $this->lang = "ar";
                break;
            default:
                $this->language_code = 1;
                $this->lang = "en";
                break;
        }
        if (request()->header('token') && auth()->check()) {
            $user=User::findOrFail(auth()->user()->id);
            $user->fcm=request()->header('token');
            $user->save();
        }
        App::setlocale($this->lang);
    }
    public function rate(Request $request)
    {
        self::set_lang();
        $validator=Validator::make(
            $request->all(),
            [
            'vendor_id'=>'required',
            ]
        );
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $review=new Reviews();
        $review->user_id=auth()->user()->id;
        $review->vendor_id=$request['vendor_id'];
        if ($request->filled('rate')) {
            $review->rate=$request['rate'];
        } else {
            $review->rate=0;
        }
        if ($request->filled('feedback')) {
            $review->feedback=$request['feedback'];
        }

        $review->save();
        $output['message']="review saved";
        $output['data']=$review;
        $output['code']=200;
        
        return response()->json($output, 200);
    }

    public function reviewAppointment(Request $request)
    {
        self::set_lang();
        $user_id=auth()->user()->id;
        $appointment=Booking::where('user_id',$user_id)
                            ->where('status','1')
                            ->where('review','0')
                            ->orderBy('date','asc')
                            ->first();
        
        $output['data']=$appointment;
        $output['has_notification']=User::where('id',$user_id)
                                        ->first()->has_notif;
        $output['code']=200;
        return response()->json($output, 200);

    }

    public function chnageBookingReview(Request $request)
    {
        self::set_lang();
        $validator=Validator::make(
            $request->all(),
            [
            'booking_id'=>'required',
            ]
        );
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $booking=Booking::where('id',$request['booking_id'])->first();
        $booking->review='1';
        $booking->save();

        $output['data']=$booking;
        $output['code']=200;
        return response()->json($output, 200);



    }
}
