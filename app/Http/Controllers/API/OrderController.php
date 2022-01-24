<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Detail;
use App\Models\BillImage;

class OrderController extends Controller
{
    public function get_orders(Request $request){
        $validation= Validator::make($request->all(), [
            'user_id'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
            if(!isset($request['page_limit'])){
                $request['page_limit'] = 10;
            }

            $orders = Order::where('user_id', $request['user_id'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $orders;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_order(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id'=>'required',
            'cart_id'=>'required',
            'details_id'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
            $cart = Cart::where('cart_id', $request['cart_id'])->first();
            if(!$cart){
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No cart';
                return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
            }
            $order = new Order;
            $order->user_id = $request['user_id'] ;
            $order->details_id = $request['details_id'] ;
            $order->status = 1 ;
            $order->price = $cart->price;
            $order->connection_type_id = $cart->connection_type_id;
            $order->number_of_connections = $cart->number_of_connections;
            $order->number_of_residents = $cart->number_of_residents;
            $order->products_price = $cart->products_price ;
            $order->vat_price = $cart->vat_price ;
            $order->total_price = $cart->total_price ;
            $order->delivery_price = $cart->delivery_price ;
            $order->grant_total_price = $cart->grant_total_price ;
            $order->save();
            $order->order_id = $order->id ;
            $order->save();
            // dd($cart->bill_images);
            //get all bill images and put thier order id and delete cart id for them
            $bill_images = $cart->bill_images;
            foreach($bill_images as $image){
                $image->cart_id = null;
                $image->order_id = $order->order_id;
                $image->save();
            }
            $cart->delete();

            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'Added Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function delete_order(Request $request){   
       $validation= Validator::make($request->all(), [
            'order_id'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $order = Order::where('order_id', $request['order_id'])->get();
            if(sizeof($order) > 0){
                $order->delete();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such order';
                return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
            }

            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'deleted Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_details(Request $request){
        $validation = Validator::make($request->all(), [
            'user_id'=>'required',
            'country_name'=>'required',
            'country_code'=>'required',
            'address'=>'required',
            'location_lat'=>'required',
            'location_long'=>'required',
            'currancy'=>'required',
            'phone'=>'required',
        ]);
        
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $details = new Detail;
            $details->user_id = $request['user_id'] ;
            $details->country_name = $request['country_name'] ;
            $details->country_code = $request['country_code'] ;
            $details->address = $request['address'] ;
            $details->location_lat = $request['location_lat'] ;
            $details->location_long = $request['location_long'] ;
            $details->currancy = $request['currancy'] ;
            $details->phone = $request['phone'] ;
            $details->save();
            
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'Added Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    public function get_details(Request $request){
        $validation= Validator::make($request->all(), [
            'user_id'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
            if(!isset($request['page_limit'])){
                $request['page_limit'] = 10;
            }

            $details = Detail::where('user_id', $request['user_id'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $details;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
