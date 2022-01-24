<?php

namespace App\Http\Controllers;

use App;
use App\Booking;
use Carbon\Carbon;
use Validator;
use App\MultiBooking;
use App\Package;
use Illuminate\Http\Request;
use App\Service;
use App\Service_vendor;
use App\Vendor;
use App\User;
use App\Code;

class UsersController extends Controller
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
    public function getAppointments(Request $request)
    {
        self::set_lang();
        $user=auth()->user();
        // dd($user);
        date_default_timezone_set("Africa/Cairo");
        $persianDate = new \DateTime(Carbon::now()->toDateTimeString());
        $persianDate = $persianDate->format('Y-m-d H:i');
        
        $array=explode(' ', $persianDate);
        $date=$array[0];
        $time=$array[1];
        
        $nextBookings=Booking::where(function ($query) use ($date, $time) {
            $query->where('bookings.date', '>=', $date)
                                ->where('bookings.time', '!=', null)
                                ->where('bookings.time', '>=', $time)
                                ->orWhere(function ($q) use ($date) {
                                    $q->where('bookings.date', '>=', $date)
                                        ->where('bookings.time', '=', null);
                                });
        })
        ->join('multi_bookings', 'multi_bookings.booking_id', 'bookings.id')
        ->join('vendors', 'vendors.id', 'bookings.vendor_id')
                        ->where('bookings.status', '=', '0')
                        ->where('bookings.user_id', $user->id)
                        ->select('bookings.*', 'vendors.image')
                        ->distinct('multi_bookings.booking_id')
                        ->orderBy('bookings.date', 'asc')
                        ;
                   

        $previousBookings=Booking::
        where('bookings.user_id', $user->id)
        ->where(function ($query) use ($date, $time) {
            $query->where('bookings.date', '<', $date)
                    ->where('bookings.time', '!=', null)
                    ->where('bookings.time', '<', $time)
                    ->orWhere(function ($q) use ($date) {
                        $q->where('bookings.date', '<', $date)
                            ->where('bookings.time', '=', null);
                    })
;
        })
                        
        ->join('multi_bookings', 'multi_bookings.booking_id', 'bookings.id')
        ->join('vendors', 'vendors.id', 'bookings.vendor_id')
        ->where('bookings.user_id', $user->id)
       
        ->orWhere(function ($query) use ($date, $time) {
            $query->where('bookings.status', '=', '2')
            ->orWhere('bookings.status', '=', '1')
                ;
        })
        // ->orWhere('bookings.status', '=', '2')
        ->where('bookings.user_id', $user->id)
        ->select('bookings.*', 'vendors.image')
        ->distinct('multi_bookings.booking_id')
        ->orderBy('bookings.date', 'desc')
        ;


        $data['data']['next']=$nextBookings->get();
        $data['data']['previous']=$previousBookings->paginate($request->limit)->toArray()['data'];
        $data['code']=200;
    
        return response()->json($data, 200);
    }


    public function getAppointmentDetails(Request $request)
    {
        self::set_lang();
        // dd(0);
        $validator=Validator::make(
            $request->all(),
            ['appointment_id'=>'required']
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $booking=Booking::where('bookings.id', $request->appointment_id)
                            ->join('vendors', 'vendors.id', 'bookings.vendor_id')
                            ->select(
                                'bookings.*',
                                'vendors.image',
                                'vendors.city_id',
                                'vendors.town_id',
                                'vendors.location',
                                'vendors.location_lng',
                                'vendors.location_lat'
                            )->first();
        if ($booking != null) {
            $booking->vendor=Vendor::where('id', $booking->vendor_id)->first();
            $booking->services=MultiBooking::where('booking_id', $request['appointment_id'])
                            ->join('services', 'services.id', 'multi_bookings.service_id')
                            ->join('service_translates', 'service_translates.service_id', 'services.id')
                            ->where('service_translates.lang', $this->lang)
                            ->select('services.*', 'service_translates.name as service_name')
                            ->get();
    
            $packages_ids=MultiBooking::where('booking_id', $request['appointment_id'])->pluck('package_id');
            // $booking['packages_all']=Package::where('vendor_id', $booking->vendor_id)
            //         ->whereIn('id', $packages_ids)
            //         ->get();
        }
        
       
                      
        $output['data']['booking']=$booking;
        // $output['data']['vendor']=$vendor;
        // $output['data']['services']=$services;
        // $output['data']['packages']=$packages;
        return response()->json($output, 200);
    }
    public function previousAppointments(Request $request)
    {
        $user=auth()->user();
        //    dd($user);
        date_default_timezone_set("Africa/Cairo");
        $persianDate = new \DateTime(Carbon::now()->toDateTimeString());
        $persianDate = $persianDate->format('Y-m-d H:i');
        $array=explode(' ', $persianDate);
        $date=$array[0];
        // dd($date);
        $bookings=Booking::where('bookings.user_id', $user->id)
                 ->where('bookings.date', '<=', $date)
                 ->join('vendors', 'vendors.id', 'bookings.vendor_id')
                 ->join('services', 'services.id', 'bookings.service_id')
                 ->join('service_translates', 'services.id', 'service_translates.service_id')
                 ->where('service_translates.lang', $request->header('language'))
                 ->orderBy('bookings.date', 'Desc')
                 ->select('bookings.*', 'vendors.image', 'service_translates.name');


        $output=$bookings->paginate($request->limit)->toArray();
        $data['data']=$output['data'];
        $data['code']=200;
        return response()->json($data, 200);
    }
    public function generalSettings(Request $request)
    {
        self::set_lang();
        $settings=Setting::all();

        $data['data']=$settings;
        $data['code']=200;
        $data['message']='ok';
        return response()->json($data, 200);
    }
    public function generateVerficationCode()
    {
        return "123456";
    }

    public function getUserCode(Request $request)
    {
        $userfriend=User::where('phone', $request['phone'])->where('friend', '1')->first();
        if ($userfriend==null) {
            $validator=Validator::make($request->all(), [
                    'phone'=>'required|unique:users,phone',

                ]);
                
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }
      
        $code_generated=self::generateVerficationCode();

        $code=new Code();
        $code->phone=$request['phone'];
        $code->verify_code=$code_generated;
        $code->save();

        $output['code']=200;
        $output['message']='code generated';
        return response()->json($output, 200);
    }
    public function verifyCode(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'phone'=>'required',
            'code'=>'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user=Code::where('phone', $request['phone'])->first();
        if ($user!=null) {
            if ($user->verify_code==$request['code']) {
                $output['code']=200;
                $output['message']='code verified';
                $output['data']=$user;
                return response()->json($output, 200);
            }
            $output['code']=400;
            $output['message']='code doesnt verified, its wrong';
            return response()->json($output, 200);
        }
        $output['code']=404;
        $output['message']='code doesnt exist';
        return response()->json($output, 200);
    }
}
