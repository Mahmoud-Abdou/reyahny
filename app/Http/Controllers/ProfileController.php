<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\PointSetting;
use App\User;
use App\UserDetails;
use App\ProductOption;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App;
class ProfileController extends Controller
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
    public function getProfile()
    { 
        self::set_lang();
        $user_id = auth()->user()->id;
        // dd($user_id);
        $data = User::find($user_id);

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] =$data;
        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function edit(Request $request)
    {
        self::set_lang();
        $user_id =  auth()->user()->id;

       

        // if ($request->image) {

            
        //     // Get file name with extension
        //     $fileNameWithExt = $request->file('image')->getClientOriginalName();

        //     //Get just filename
        //     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //     // Get just ext
        //     $extension = $request->file('image')->getClientOriginalExtension();

        //     // Filename to store
        //     $fileNameToStore = $fileName.'_'.time().'.'.$extension;

        //     // Upload Image
        //     $path = $request->file('image')->storeAs('public/profiles', $fileNameToStore);

        //     $request->image = $fileNameToStore;
        //     $user=User::where('id',$user_id)->first();
        //     $user->image=$request->image;
        //     $user->save();
           
        // }
        $user=User::where('id',$user_id)->first();
        
        if($request->filled('image')){
            $user->image=$request['image'];
        }
        if($request->filled('name')){
            $user->name=$request['name'];
        }
        if($request->filled('phone')){
            $user->phone=$request['phone'];
        }
        if($request->filled('city')){
            $user->city=$request['city'];
        }
        if($request->filled('twon')){
            $user->twon=$request['twon'];
        }
        if($request->filled('password')){
            $user->password=bcrypt($request['password']);
        }

        $user->save();


        $output['message'] = "profile updated successfully";
        $output['code'] = 200;
        $output['data'] =$user;

        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function myPoints(Request $request)
    {
        self::set_lang();

        $user_id = auth()->user()->id;

        $user = UserDetails::where('user_id', $user_id)->first();

        $total_order_points = $user->total_order_points;

        $points_settings = PointSetting::first();

        $rank_number = $points_settings->rank_number;

        $bronze = $points_settings->rank_number_bronze;

        $silver = $points_settings->rank_number_silver;

        $gold = $points_settings->rank_number_gold;
        if($user->default_rank!=0)
        {
            $user["rank"]=$user->default_rank;
        }
        else
        {
            if ($total_order_points >= $rank_number) {
                $user['rank'] = 'GOLD';
            }
            if ($total_order_points == 0 || $total_order_points < $bronze) {
                $user['rank'] = 'Unranked';
            }
            if ($total_order_points >= $bronze && $total_order_points <= $silver) {
                $user['rank'] = 'BRONZE';
            }
            if ($total_order_points >= $silver && $total_order_points <= $gold) {
                $user['rank'] = 'SILVER';
            }
            if ($total_order_points >= $gold) {
                $user['rank'] = 'GOLD';
            }
        }
        $output['data'] =  $user;
        $output['message'] = true;
        $output['code'] = 200;

        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function myOrders(Request $request)
    {
        self::set_lang();

        if ($request->header('status')) {
            $status = $request->header('status');
        } else {
            $status = 0;
        }

        $user_id = auth()->user()->id;

        $user_id = auth()->user()->id;

        $orders = Order::
                with('product')
                ->where('user_id', $user_id)
                ->where('status', $status)->orderByDesc('created_at')
                // ->join("product_options", "orders.id", "product_options.order_id")
                // ->select("Order.*", "")
                ->get();
        $neworders=[];
        foreach ($orders as $order) {
            $neworder=$order;
            if ($order->product !=  null) {
                $ProductOptions = ProductOption::where('product_id', $order->product->id)
                ->where("order_id", $order->id)
                ->select("card_number")->first();
                if ($ProductOptions != null) {
                    $neworder->card_number=$ProductOptions->card_number;
                }
            }
            $neworders[]=$neworders;
        }

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $orders;

        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function myPayments(Request $request)
    {
        self::set_lang();
        $user_id = auth()->user()->id;

        $payments = Payment::where('user_id', $user_id)->orderByDesc('created_at')->get();

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $payments;

        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function redeem_points(Request $request)
    {
        self::set_lang();

        $user_id = auth()->user()->id;

        $pointsSetting = PointSetting::first();
        $user = UserDetails::where('user_id', $user_id)->first();
        $pointstoberedeemed= $user->total_order_points;

        $tobeadded=((double)$pointstoberedeemed/(double)$pointsSetting->amount_of_currency) * $pointsSetting->amount_of_points;
        $newUserPoints=$user->total_points + $tobeadded;  // raise amount of money with reedemed points value
        $total_order_points=0;   // make it zero after redeemed done

        $user->total_points=  $newUserPoints; // it is money not points
        $user->total_order_points=  $total_order_points ; // its points for order done
        $user->save();  // its points for order done
     
        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $user;

        return  response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

}
