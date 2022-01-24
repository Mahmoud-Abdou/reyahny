<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Notification;
use App\Http\Controllers\Redirect;
use App;
class NotificationCOntroller extends Controller
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
    
    public function index(Request $request)
    {
        
        self::set_lang();
        return view('dashboard.notifications.notifications', [
            'titleofpage' =>__('lang.notifications'),
            'lang'=>$this->lang
        ]);
    }

    public function notifyAll(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user=User::where('role','admin')->first();
        $flag=$user->sendNotifyAll($request['body'],$request['title'],$request['type']);
        
        

       
        

        if($flag==1){
            // dd(0);
            $notfication=new Notification();
        if($request['type']==1){
            //users
            $notfication->user_id=-1;
        }
        else if($request['type']==0){
            //vendors
            $notfication->user_id=-2;
        }
        else{
            //all
            $notfication->user_id=-3;

        }
        $notfication->type="3";
        $notfication->not_title=$request['title'];
        $notfication->data=$request['body'];
        $notfication->save();

        $out['code']=200;
        return response()->json($out,200)  ;
         }
        else{
            $out['code']=400;
            return response()->json($out,400) ; 


        }
    }
}
