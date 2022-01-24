<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
class ProductController extends Controller
{
    public function get_products(Request $request){
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

            $products = Product::where('service_id', $request['service_id'])
                                ->where('lang_code', $request['lang_code'])
                                ->paginate($request['page_limit']);
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = $products;
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function add_product(Request $request){
        $validation= Validator::make($request->all(), [
            'service_id'=>'required',
            'name'=>'required',
            'description'=>'required',
            'image'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $product = new Product;
            $product->service_id = $request['service_id'] ;
            $product->name = $request['name'] ;
            $product->lang_code = 'ar';
            $product->description = $request['description'] ;
            $product->image = $request['image'] ;
            $product->save();
            $id = $product->id;
            $product->product_id = $id;
            $product->save();
            
            $product = new Product;
            $product->product_id = $id;
            $product->service_id = $request['service_id'] ;
            $product->name = $request['name'] ;
            $product->lang_code = 'en';
            $product->description = $request['description'] ;
            $product->image = $request['image'] ;
            $product->save();

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

    public function edit_product(Request $request){
        $validation= Validator::make($request->all(), [
            'product_id'=>'required',
            'name'=>'required',
            'description'=>'required',
            'image'=>'required',
            'lang_code'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $product = Product::where('product_id', $request['product_id'])->where('lang_code', $request['lang_code'])->first();
            if($product){
                $product->name = $request['name'] ;
                $product->description = $request['description'] ;
                $product->image = $request['image'] ;
                $product->save();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such product';
                return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
            }

            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'Edited Succ';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e){
            $output['message'] = true;
            $output['code'] = 400;
            $output['data'] = 'Somthing Went Wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function delete_product(Request $request){   
       $validation= Validator::make($request->all(), [
            'product_id'=>'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        try{
        
            $product = Product::where('product_id', $request['product_id'])->get();
            if(sizeof($product) > 0){
                $product->delete();
            }
            else{
                $output['message'] = true;
                $output['code'] = 400;
                $output['data'] = 'No such product';
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
}
