<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Cart;
use App\Models\CartService;
use App\Models\ConnectionType;
use App\Models\BillImage;

class CartController extends Controller
{
    public function get_carts(Request $request){
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

            $carts = Cart::services()->where('carts.service_id', $request['service_id'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $carts;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_cart(Request $request){
        $validation= Validator::make($request->all(), [
            'user_id'=>'required',
            'service_id'=>'required',
            'price'=>'required',
            'water_pipe_diameter_id'=>'required',
            'number_of_connections'=>'required',
            'number_of_residents'=>'required',
            'products_price'=>'required',
            'vat_price'=>'required',
            'total_price'=>'required',
            'delivery_price'=>'required',
            'grant_total_price'=>'required',
        ]);
        

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
            $cart = Cart::where('user_id', $request['user_id'])->first();
            if($cart){
                $cart->service_id = $request['service_id'] ;
                $cart->user_id = $request['user_id'] ;
                $cart->price = $request['price'] ;
                $cart->water_pipe_diameter_id = $request['water_pipe_diameter_id'] ;
                $cart->number_of_connections = $request['number_of_connections'] ;
                $cart->number_of_residents = $request['number_of_residents'] ;
                $cart->products_price = $request['products_price'] ;
                $cart->vat_price = $request['vat_price'] ;
                $cart->total_price = $request['total_price'] ;
                $cart->delivery_price = $request['delivery_price'] ;
                $cart->grant_total_price = $request['grant_total_price'] ;
                $cart->save();
                $cart->cart_id = $cart->id ;
                $cart->save();
            }
            else{
                $cart = new Cart;
                $cart->service_id = $request['service_id'] ;
                $cart->user_id = $request['user_id'] ;
                $cart->total = $request['total'] ;
                $cart->water_pipe_diameter_id = $request['water_pipe_diameter_id'] ;
                $cart->number_of_connections = $request['number_of_connections'] ;
                $cart->number_of_residents = $request['number_of_residents'] ;
                $cart->products_price = $request['products_price'] ;
                $cart->vat_price = $request['vat_price'] ;
                $cart->total_price = $request['total_price'] ;
                $cart->delivery_price = $request['delivery_price'] ;
                $cart->grant_total_price = $request['grant_total_price'] ;
                $cart->save();
                $cart->cart_id = $cart->id ;
                $cart->save();

            }
            

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


    public function delete_cart(Request $request){   
       $validation= Validator::make($request->all(), [
            'cart_id'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $cart = Cart::where('cart_id', $request['cart_id'])->first();
            if($cart){
                $cart_service = CartService::where('cart_id', $request['cart_id'])->get();
                if(sizeof($cart) > 0){
                    $cart_service->delete();
                }
                $cart->delete();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such cart';
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

    public function delete_cart_service(Request $request){   
        $validation= Validator::make($request->all(), [
             'cart_service_id'=>'required'
         ]);
 
         if ($validation->fails()) {
             return response()->json($validation->errors(), 400);
         }
 
         try{
         
             $cart = CartService::where('cart_service_id', $request['cart_service_id'])->first();
             if($cart){
                $cart->delete();
             }
             else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such cart service';
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

    public function get_connection_types(Request $request){
        $validation= Validator::make($request->all(), [
            'service_id'=>'required',
            'lang_code'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
            if(!isset($request['page_limit'])){
                $request['page_limit'] = 10;
            }

            $connection_types = ConnectionType::where('service_id', $request['service_id'])
            ->where('lang_code', $request['lang_code'])->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $connection_types;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    

    public function add_billimages(Request $request){
        $validation= Validator::make($request->all(), [
            'bill_price'=>'required',
            'bill_date'=>'required',
            'user_id'=>'required',
            'cart_id'=>'required',
            'image'=>'required',
        ]);
        

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
            
            $billImage = new BillImage;
            $billImage->bill_price = $request['bill_price'] ;
            $billImage->bill_date = $request['bill_date'] ;
            $billImage->user_id = $request['user_id'] ;
            $billImage->cart_id = $request['cart_id'] ;
            $billImage->image = $request['image'] ;
            $billImage->save();
            
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
    
}
