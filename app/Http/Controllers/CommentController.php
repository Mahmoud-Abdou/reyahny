<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Validator;
use App\User;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
       $validator=Validator::make($request->all(),[
           'comment'=>'required',
           'vendor_id'=>'required',
       ]);
       if($validator->fails()){
           return response()->json($validator->errors(),401);
       }
       $comment=new Comment();
       $comment->content=$request['comment'];
       $comment->vendor_id=$request['vendor_id'];
       $comment->save();


       $output['data']=$comment;
       $output['message']="ok";
       $output['code']=200;

       return response()->json($output,200);
    }
}
