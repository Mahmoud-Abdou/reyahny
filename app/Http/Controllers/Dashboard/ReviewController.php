<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reviews;
use Validator;
use App;
use App\Vendor;
class ReviewController extends Controller
{
    public function set_lang()
    {
        switch (session()->get('lang')) {
            case 'en':
                $this->lang = "en";
                break;
            case 'ar':
                $this->lang = "ar";
                break;

            default:
                $this->lang = "en";
                break;
        }
        App::setlocale($this->lang);
    }

    public function index()
    {
        self::set_lang();
        $vednors=Vendor::where('parent_vendor','0')->select('id','name')->get();
        // dd($vednors);
        return view('dashboard.reviews.reviews',[
            'titleofpage'=>__('lang.reviews'),
            'lang'=>$this->lang,
            'vednors'=>$vednors,
            
        ]);
    }

    public function getReviews(Request $request)
    {
        // self::set_lang();
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }
        $query_length = $request['length'];

        $Reviews=new Reviews();
        $columns=[
            
            "2"=>"feedback",
            "3"=>"rate",
        ];
        $data=null;
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        if ($column!=null) {
            $data = $Reviews->
            orderBy($column, $dir);
        }else{
            $data = $Reviews->
            orderBy("updated_at", "DESC");
        }   
        if ($request["search"]["value"]  != null) {
            $data = $Reviews::
                where("rate", 'like', '%'.$request['search']["value"].'%')
                ->orWhere("feedback", 'like', '%'.$request['search']["value"].'%')
                ;
            
        }
        
        if($request->filled("vendor_id")){
            // dd($request->vendor_id);
            if($request['vendor_id']!=null){
                // dd($request->vendor_id);
                $data = $Reviews::where('vendor_id',$request['vendor_id']);  
            }
        }
        $count=$data->count();
        $data=$data->paginate($query_length)->toArray();
         $data['recordsTotal']=  $count;
        $data['recordsFiltered']=  $count;

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function destroy(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'review_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),404);
        }
        $review=Reviews::find($request['review_id'])->delete();
        $out['message']="deleted";
        $out['code']=200;

        return response()->json($out,200);


    }

    public function update(Request $request)
    {
       $validator=Validator::make($request->all(),[
           'review_id'=>'required',
           'feedback'=>'required',
           'action'=>'required',
       ]);

       if($validator->fails()){
           return response()->json($validator->errors(),404);
       }
       $review=Reviews::find($request['review_id']);
       $review->feedback=$request['feedback'];
       $review->action=$request['action'];
       $review->save();

       $out['code']=200;
       return response()->json($out,200);
    }

}
