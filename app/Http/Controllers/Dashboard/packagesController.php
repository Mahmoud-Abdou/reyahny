<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use App\Vendor;
use App\Service;
use App\User;
use App\Booking;
use Validator;
use App\Package;
use App\PackageTranslate;
use App\Service_vendor;
use App\Languages;
use App\ServiceTranslate;
class packagesController extends Controller
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
        // dd(0);
        self::set_lang();
        $vendors=Vendor::select('id','name')->get();
        $services=Service::join('service_translates','service_translates.service_id','services.id')
                        ->where('service_translates.lang',$this->lang)
                        ->select('services.id','service_translates.name')
                        ->get();
        $packages=Package::join('package_translates','package_translates.packaged_id','packages.id')
                        ->where('package_translates.lang',$this->lang)
                        ->select('packages.*','package_translates.name','package_translates.service_id',
                    )->get();
                    // dd($packages);
        
        $users=User::where('role','user')->select('id','name')->get();
        return view('dashboard.packages.packages',[
            'titleofpage'=>__('lang.packages'),
            'lang'=>$this->lang,
            'vendors'=>$vendors,
            'services'=>$services,
            'users'=>$users,
            'packages'=> $packages,
        ]);
    }

    public function getPackages(Request $request)
    {
        self::set_lang();
        if ($request->start ==0) {
            $request['page']=1;
        } else {
            $request['page']= ($request->start / $request->length)+1;
        }
        $query_length = $request['length'];
        $packages=Package::rightJoin('package_translates','package_translates.packaged_id','packages.id')
                            ->where('package_translates.lang',$this->lang)
                            ->select('packages.*','package_translates.name','package_translates.service_id',
                        );
        $columns=[
            "0"=>"packages.vendor_id",
            "1"=>"package_translates.name",
            "2"=>"packages.cost",
            "3"=>"packages.discount",
            "4"=>"packages.duration",
        ];
        $data=null;
        $column= isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] :null;
        $dir=$request["order"][0]["dir"];
        if ($column!=null) {
            $data = $packages->
            orderBy($column, $dir);
        }else{
            $data = $packages->
            orderBy("town_translates.updated_at", "DESC");
        }   
        if ($request["search"]["value"]  != null) {
            $data = $data->
                where("package_translates.name", 'like', '%'.$request['search']["value"].'%')
                ->orWhere("packages.cost", 'like', '%'.$request['search']["value"].'%')
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
    //    dd($request->all());
       $validation = Validator::make($request->all(), [
        'package_id'=>'required',
        'cost' => 'required',
        'discount' => 'required',
        'duration' => 'required',
        'service' => 'required',
        'sub_id' => 'required',
        'vendor_id'=>'required',
       
        
    ]);
    if ($validation->fails()) {
        return response()->json($validation->errors(), 404, [], JSON_UNESCAPED_UNICODE);
    }
    $languages=Languages::pluck('language_code')->toArray();

    if($request['package_id']=='new_one')
    {

        $package=new Package();
        $package->vendor_id=$request['vendor_id'];
        $package->cost=$request['cost'];
        $package->discount=$request['discount'];
        $package->duration=$request['duration'];
        $package->save();
        foreach($languages as $lang){

            $package_trans=new PackageTranslate();
            $package_trans->packaged_id=$package->id;
            $package_trans->name=$request['new_package_name'];
            $package_trans->lang=$lang;
            if($request->filled('new_service')){
                $service=new Service();
                if($request->sub_id!=null){

                    $service->parent_service=$request['sub_id'];
                }
                else{
                    $service->parent_service=$request['service'];

                }
                $service->save();
                foreach($languages as $llang){

                    $service_trns=new ServiceTranslate();
                    $service_trns->service_id=$service->id;
                    $service_trns->name=$request['new_service'];
                    $service_trns->lang=$llang;
                    $service_trns->save();

                }
                $package_trans->service_id=$service->id;
            }
            else{
                if($request['sub_id']!="null"){

                    $package_trans->service_id=$request['sub_id'];

                }
                else{
                    $package_trans->service_id=$request['service'];

                }
            }
            $package_trans->pack_service_discount=$request['discount'];
            $package_trans->pack_service_cost=$request['cost'];
            $package_trans->save();

        }
    }
    else{
        // dd($request['package_id']);
        $old_package=Package::find($request['package_id']);
        $old_package_trans=PackageTranslate::where('packaged_id',$old_package->id)
                                            ->where('name','!=',null)
                                            ->first();
        if($old_package==null){
            $out['code']=400;
            $out['message']='package does not exist';

            return response()->json($out,400);
        }
        foreach($languages as $lang){

            $new_package_trans=new PackageTranslate();
            $new_package_trans->packaged_id=$old_package->id;
            $new_package_trans->name=$old_package_trans->name;
            $new_package_trans->lang=$lang;
            if($request->filled('new_service')){
                $service=new Service();
                if($request->sub_id!=null){

                    $service->parent_service=$request['sub_id'];
                }
                else{
                    $service->parent_service=$request['service'];

                }
                $service->save();
                foreach($languages as $llang){

                    $service_trns=new ServiceTranslate();
                    $service_trns->service_id=$service->id;
                    $service_trns->name=$request['new_service'];
                    $service_trns->lang=$llang;
                    $service_trns->save();
                }
            $new_package_trans->service_id=$service->id;

            }
            else{
                if($request['sub_id']!="null"){

                    $new_package_trans->service_id=$request['sub_id'];

                }
                else{
                    $new_package_trans->service_id=$request['service'];

                }
            }
            $new_package_trans->pack_service_discount=$request['discount'];
            $new_package_trans->pack_service_cost=$request['cost'];
            $new_package_trans->save();

        }

        $out['code']=200;
        $out['message']="sotred";

        return response()->json($out,200);
        

    }


    }
    public function getVendorServices(Request $request)
    {
        
        self::set_lang();
        // $vendors_ids=Vendor::where('user_id',$user_vendor->id)->pluck('id');
        
        $services_vendor=Service_vendor::where('vendor_id',$request['vendor_id'])
                                        ->join('services','services.id','services_vendors.service_id')
                                        ->join('service_translates','services.id','service_translates.service_id')
                                        ->where('service_translates.lang',$this->lang)
                                        ->where('services.parent_service','0')
                                        ->select('services.*','service_translates.name')
                                        ->get();

        $output['data']=$services_vendor;
        $output['code']=200;
        $output['message']='ok';
    
        return response()->json($output, 200);
    }
}
