<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Validator;
use App\Comment;
use App\Vendor;
class CommentController extends Controller
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
        $vendors=Vendor::select('id','name','phone')->get();
        return view('dashboard.comments.comments', [
            'titleofpage'=>__('lang.comments'),
            'vendors'=>$vendors
        ]);
    }
    public function getcomments(Request $request)
    {
        self::set_lang();
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }
        $query_length = $request['length'];
        $comments=new Comment();
        $columns=[
            "0"=>"vendor_id",
            "1"=>"user_id",
            "2"=>"content",
       
        ];
        $data=null;
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        if ($column!=null) {
            $data = $comments->
            orderBy($column, $dir);
        }else{
            $data = $comments->
            orderBy("updated_at", "DESC");
        }   
        if ($request["search"]["value"]  != null) {
            $data = $data->
                where("content", 'like', '%'.$request['search']["value"].'%')
               
                ;
            
        }
        $count=$data->count();
        $data=$data->paginate($query_length)->toArray();
        $data['recordsTotal']=  $count;
        $data['recordsFiltered']=  $count;

        // dd($languages);
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function destroy(Request $request)
    {
        self::set_lang();
        $validator=Validator::make($request->all(), [
            'comment_id'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment=Comment::where('id',$request['comment_id'])->first();

        if($comment!=null){
            $comment->delete();
            $output['message']='comment deleted successfully';
            $output['code']=200;

            return response()->json($output,200);
        }
        
        $output['message']='comment does not exist';
        $output['code']=400;

        return response()->json($output,200);

    }
    public function store(Request $request)
    {
        self::set_lang();
        $validator=Validator::make($request->all(), [
            'comment'=>'required',
            'vendor_id'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $comment=new Comment();
        $comment->vendor_id=$request['vendor_id'];
        $comment->content=$request['comment'];
        $comment->save();
        $output['message']='comment added successfully';
        $output['code']=200;

        return response()->json($output,200);
    }
}
