<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\contactuses;
use Illuminate\Http\Request;
use App;
use App\Contactus;
use Validator;
class ContactUsController extends Controller
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

        return view('dashboard.contactus.contactus',[
            'titleofpage'=>__('lang.contactus'),
            'lang'=>$this->lang
            
        ]);
    }

    
    public function getContactUs(Request $request)
    {
        self::set_lang();
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }
        $query_length = $request['length'];

        $Contactus=Contactus::query();
        // dd($Contactus);
        // if ($Contactus==null) {
        //     $output['message'] = 'No data entry';
        //     $output['code'] = 404;
        //     $output['data'] = $Contactus;

        //     return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        // }
        $columns=[
            
            "1"=>"subject",
            "2"=>"message",
        ];
        $data=null;
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        if ($column!=null) {
            $data = $Contactus->
            orderBy($column, $dir);
        }
        else{
            if($Contactus!=null){

                $data = $Contactus->
                orderBy("updated_at", "DESC");
            }
            else{
                $data = $Contactus;
            }
        }   
        if ($request["search"]["value"]  != null) {
            $data = $Contactus::
                where("subject", 'like', '%'.$request['search']["value"].'%')
                ->orWhere("message", 'like', '%'.$request['search']["value"].'%')
                ;
            
        }
        $count=$data->count();
        $data=$data->paginate($query_length)->toArray();
        $data['recordsTotal']=  $count;
        $data['recordsFiltered']=  $count;

        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

   
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contactuses  $contactuses
     * @return \Illuminate\Http\Response
     */
    public function show(contactuses $contactuses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contactuses  $contactuses
     * @return \Illuminate\Http\Response
     */
    public function edit(contactuses $contactuses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contactuses  $contactuses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id'=>'required',
            'feedback'=>'required',
            'action'=>'required',
            'notes'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $contact_us=Contactus::where('id',$request['id'])->first();
        if($contact_us!=null){
            $contact_us->notes=$request['notes'];
            $contact_us->feedback=$request['feedback'];
            $contact_us->action=$request['action'];
            $contact_us->save();

            $out['code']=200;
            return response()->json($out,200);
        }
        $out['code']=400;
        $out['message']="doesnt exist";
        return response()->json($out,400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contactuses  $contactuses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $package=Contactus::find($request['contact_us_id']);
        $package->delete();

        $out['code']=200;
        return response()->json($out,200);
    }
}
