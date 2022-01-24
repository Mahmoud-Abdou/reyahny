<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App;
use App\Category;
use App\GeneralSetting;
use App\Group;
use App\Order;
use App\Payment;
use App\Product;
use App\Booking;
use App\Service;
use App\Vendor;
use App\UserDetails;
use Validator;
use DB;
use App\PointSetting;
use Carbon\Carbon;
use App\Setting;
use Illuminate\Database\Eloquent\Collection;
use App\CityTranslate;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        self::set_lang();
        $data = [];
        $user=User::where('id', session()->get('user_id'))->first();
        // dd($user->roles);
        $data['users'] = User::where('role', "user")->count();
        $data['user'] = $user;
        // $data['vendors'] = Vendor::count();
        // $parent_services = Service::where("parent_service", "0");
        // $data['services'] =$parent_services->count();
        // $data['parent_services'] =Service::join(
        //     'service_translates',
        //     'service_translates.service_id',
        //     'services.id'
        // )
        // ->where('services.parent_service', '!=', '0')
        // ->where('services.special', '!=', '0')
        // ->where('service_translates.lang', session()->get('lang'))
        // ->select('service_translates.name', 'services.id')
        // ->get();
        // $data['sub_services'] = Service::where("parent_service", "!=", "0")->count();
        // $data['bookings'] = Booking::count();
        // $data['cancelled_bookings_user'] = Booking::where('status', '2')->where('status_owner', 'user')->count();
        // $data['cancelled_bookings_vendor'] = Booking::where('status', '2')->where('status_owner', 'vendor')->count();
        // $data['completed_bookings_vendor'] = Booking::where('status', '1')->count();
        // $data['notshown_bookings'] = Booking::where('status', '3')->count();
        // $data['pending_bookings'] = Booking::where('status', '0')->count();
        
        return view('dashboard.control_panel', [
            'titleofpage' => __('lang.control_panel'),
            'data' => $data
        ]);
    }

    public function setlang($lang)
    {
        App::setLocale($lang);
        session()->put('lang', $lang);
        session()->put('language', $lang);
        return back();
    }

    public function login()
    {
        // $user=new User();
        // $user->name="admin";
        // $user->email="admin@admin.com";
        // $user->password=bcrypt("123456");
        // $user->role='admin';
        // $user->save();
        // return $user;
        self::set_lang();
        // dd(Auth::user());

        $settings = Setting::first();
        if (session()->has('loggedin') == 'true') {
            return redirect("/");
        } else {
            return view('dashboard.login', [
                'titleofpage' => __('lang.login'),
                'settings' => $settings
                ]);
        }
    }

    public function user_login(Request $request)
    {
        // dd(Auth::user());
        self::set_lang();
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        }

        // dd($request->all());
        $user = User::where('email', $request['email'])
            ->whereIn('role', ['admin','assistant'])
            ->first();
            
            
            
            if ($user && password_verify($request['password'], $user->password)) {
                // $user->assignRole('admin');
                // dd($user);
            session()->put('lang', $this->lang);
            App::setLocale($this->lang);
            session()->put('lang', $this->lang);
            session()->put('language', $this->lang);
            session()->put('loggedin', "true");
            session()->put('user', $user);
            session()->put('user_id', $user->id);
            session()->put('role', $user->role);
            // $credentials = $request->only('email', 'password');

            if (Auth::attempt(['email' =>$request['email'], 'password' => $request['password']])) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            // return redirect('/dashboard');
        }
        session()->flash('danger', 'Userdoesnotexists');
        return redirect('/login');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);
        // dd($request);
        if ($request->file('file') != null) {
            $Image = $request->file('file');
            if ($Image->getClientOriginalExtension() == "js" || $Image->getClientOriginalExtension() == "php" || $Image->getClientOriginalExtension() == "sql") {
                session()->flash('danger', 'wrong bad behavoir happend');
            }
            $newImageName = uniqid() . "." . $Image->getClientOriginalExtension();

            $Image->move('images/', $newImageName);

            $image_path = 'images/' . $newImageName;
            return $image_path;
        } else {
            session()->flash('danger', 'wrong bad behavoir happend');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect("/");
    }

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


    public function users($id)
    {
        self::set_lang();

        return view('dashboard.users.users', [
            'titleofpage' => __('lang.users'),
            'trader_user_id' => $id
        ]);
    }


    public function charge(Request $request)
    {
        self::set_lang();

        $validation = Validator::make($request->all(), [
            'amount' => 'required',
            'payment_type' => 'required',
            'user_id' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $user_id = $request->user_id;
        $pointsSetting = PointSetting::first();
        $eastern_arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $western_arabic = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

        $str_amount = str_replace($eastern_arabic, $western_arabic, $request['amount']);
        // $amountOfChargedPoints = ((double)$request->amount/(double)$pointsSetting->amount_of_currency) * $pointsSetting->amount_of_points;
        $amountOfChargedPoints = $str_amount;

        $user = UserDetails::where('user_id', $user_id)->first();

        $oldUserTotalPoints = $user->total_points;

        $newUserTotalPoints = $oldUserTotalPoints + $amountOfChargedPoints;

        UserDetails::where('user_id', $user_id)->update([
            'total_points' => $newUserTotalPoints
        ]);

        $user = UserDetails::where('user_id', $user_id)->first();

        Payment::create([
            'user_id' => $user_id,
            'value' => $request['amount'],
            'amount_of_points' => $amountOfChargedPoints,
            'type' => $request['payment_type']
        ]);

        $output['message'] = 'Charged Successfully';
        $output['code'] = 200;
        $output['data'] = $user;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function users_index(Request $request)
    {
        self::set_lang();
        $cities=CityTranslate::where('language_code', session()->get('lang'))->get();
        $roles=Role::pluck("id", "name");
        // dd($roles);
        return view('dashboard.users.users', [
            'titleofpage' =>__('lang.users'),
            'cities'=>$cities,
            'roles'=>$roles,
            
        ]);
    }

    public function get_users(Request $request)
    {
        self::set_lang();


        if ($request->start == 0) {
            $request['page'] = 1;
        } else {
            $request['page'] = ($request->start / $request->length) + 1;
        }

        $query_length = $request['length'];


      
        $users = User::where('role', $request['role']);
       
        
        $columns = [
            // 1=>"users.name",
            0 => "users.name",
            2 => "users.phone",
           
            

        ];

        $column = isset($columns[$request["order"][0]["column"]]) ? $columns[$request["order"][0]["column"]] : null;
        $dir = $request["order"][0]["dir"];
        if ($column != null) {
            $data = $users->
            orderBy($column, $dir);
        }
       

        if ($request["search"]["value"] != null) {
            $users = $users->where('name', 'like', '%' . $request['search']["value"] . '%');
            // ->orWhere('user_details.company_name', 'like', '%' . $request['search']["value"] . '%')
                // ->orWhere('user_details.country_name', 'like', '%' . $request['search']["value"] . '%');
        }
        // dd($users->get());
        $count = $users->count();
        $data = $users->paginate($query_length)->toArray();
        $data['recordsTotal'] = $count;
        $data['recordsFiltered'] = $count;
        // dd($data);
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function delete_user(Request $request)
    {
        self::set_lang();

        User::where('id', $request->user_id)->delete();

        // UserDetails::where('user_id', $request->user_id)->delete();

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = "deleted succ";
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function get_chart_months_parameters_status4(Request $request)
    {
        self::set_lang();

        $validation = Validator::make($request->all(), [
            'year' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $payments = Payment::selectRaw(" SUM(value) value,  date_FORMAT(created_at, '%Y %m ') datee")
            ->where('created_at', 'like', $request['year'] . '%')
            ->groupBy('datee')
            ->orderBy('datee', 'ASC')
            ->get();

        $payments_values = [];
        $months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        for ($i = 0; $i < 12; $i++) {
            array_push($payments_values, 0);
        }
        foreach ($payments as $payment) {
            $month = explode(" ", $payment['datee']);
            $month = $month[1];

            $payments_values[(int)($month) - 1] = $payment['value'];
        }
        $output['message'] = true;
        $output['code'] = 200;
        $output['months'] = $months;
        $output['rates'] = $payments_values;


        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function get_chart_revenue_parameters_status4(Request $request)
    {
        self::set_lang();

        $validation = Validator::make($request->all(), [
            'year' => 'required',
            'month' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $month = $request['year'] . "-";
        if ($request['month'] > "9") {
            $month .= $request['month'];
        } else {
            $month .= "0" . $request['month'];
        }
        $payments = Payment::selectRaw(" SUM(value) value,  date_FORMAT(created_at, '%Y %m %e') datee")
            ->where('created_at', 'like', $month . '%')
            ->groupBy('datee')
            ->orderBy('datee', 'ASC')
            ->get()->toArray();

        $payments_values = [];
        $days = ["01", "02", "03", "04", "05", "06", "07", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
        for ($i = 1; $i < 32; $i++) {
            array_push($payments_values, 0);
        }
        foreach ($payments as $payment) {
            $day = explode(" ", $payment['datee']);
            $day = $day[2];

            $payments_values[(int)($day) - 1] = $payment['value'];
        }

        $output['message'] = true;
        $output['code'] = 200;
        $output['days'] = $days;
        $output['rates'] = $payments_values;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }


    // update default rank

    public function updateDefaultRank(Request $request)
    {
        self::set_lang();

        $validator = Validator::make($request->all(), [
            "user_id" => "required",
            "default_rank" => "required",
            'name' => 'required',
            'email' => ['required'],

            'country' => 'required',
            'country_key' => 'required',
            'location_lat' => 'required',
            'location_long' => 'required',
            'currency' => 'required',
            'company_name' => 'required',
            'country_code' => 'required',
            'phone' => 'required',

        ]);

//        $credentials = request(['name', 'email', 'password']);

//        $userDetails = request(['country' , 'company_name', 'country_code', 'country_key','location_lat','location_long', 'currency', 'phone']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::findOrFail($request['user_id']);
        if ($user == null) {
            $output["message"] = "user not found";
            $output["code"] = 404;

            return response()->json($output, 404, [], JSON_UNESCAPED_UNICODE);
        }
        $user->name = $request['name'];
        $user->email = $request['email'];
        $userDetails = UserDetails::where("user_id", $request["user_id"])->first();

        if ($userDetails == null) {
            $output["message"] = "user not found";
            $output["code"] = 404;

            return response()->json($output, 404, [], JSON_UNESCAPED_UNICODE);
        }
        $userDetails->country_name = $request['country'];
        $userDetails->company_name = $request['company_name'];
        $userDetails->country_code = $request['country_code'];
        $userDetails->country_key = $request['country_key'];
        $userDetails->location_lat = $request['location_lat'];
        $userDetails->location_long = $request['location_long'];
        $userDetails->currency = $request['currency'];
        $userDetails->phone = $request['phone'];
        $userDetails->default_rank = $request["default_rank"];
        $userDetails->save();

        $output['message'] = "updated successfully";
        $output['code'] = 200;
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getUsersForYearDefault($date)
    {
        self::set_lang();

        $xValues = array();
        $yValues = array();
        $fromDate = $date;
        $currentYear = now()->year;
        for ($i = $fromDate; $i <= $currentYear; $i++) {
            array_push($xValues, $i);
            array_push($yValues, User::whereYear('created_at', $i)
                                        ->where('role', 'user')
                                        ->count());
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['message'] = "ok ya";
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getUsersStatistics(Request $request)
    {
        self::set_lang();
        $mytime = Carbon::now();
        $mytime=($mytime->toDateString());
        if ($request->from!=null &&$request->to!=null) {
            $start=$request->from;
            $end=$request->to;
        } elseif ($request->from!=null&&$request->to==null) {
            $start=$request->from;
            $end=$mytime;//for the now
            // dd(0);
        } elseif ($request->from==null&&$request->to!=null) {
            $end=$request->to;
            $start=User::first()->date;// form  now;
        } else {
            $start=null;
            $end=null;
        }

        if ($start==null&&$end==null) {
            $users=User::whereDate('created_at', '>=', $mytime);
        } else {
            $users= User::whereDate('created_at', '>=', $start)
                                    ->whereDate('created_at', '<=', $end);
        }
        $users=$users->get();
        $yValues = array();
        $xValues = array();
        $arr=[];
        foreach ($users as $users) {
            $arr[$users->created_at->format('Y-m-d')]=$users->whereDate('created_at', $users->created_at->format('Y-m-d'))
            ->count();
        }
        foreach ($arr as $key=>$value) {
            $xValues[]=$key;
            $yValues[]=$value;
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['data'] = $arr;
        $output['message'] = "ok";
        $output['code'] = 200;
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getUsersForDays($year, $month)
    {
        self::set_lang();

        $yValues = array();
        $xValues = array();
        for ($i = 1; $i <= 31; $i++) {
            array_push($xValues, $i);
            try {
                array_push($yValues, User::whereDate('created_at', $year . "-" . $month . '-' . $i)
                                            ->where('role', 'user')->count());
            } catch (\Exception $e) {
                array_push($yValues, 0);
            }
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['message'] = "ok";
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //payments statistics

    public function getPaymentsForYearDefault($date)
    {
        self::set_lang();

        $xValues = array();
        $yValues = array();
        $fromDate = $date;
        $currentYear = now()->year;
        for ($i = $fromDate; $i <= $currentYear; $i++) {
            array_push($xValues, $i);
            try {
                array_push($yValues, Booking::whereYear('created_at', $i)
                                        ->where('status', '1')
                                        ->count());
            } catch (\Exception $e) {
                array_push($yValues, 0);
            }
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['message'] = "ok ya";
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getPaymentsStatistics(Request $request)
    {
        self::set_lang();
        // dd(0);
        $mytime = Carbon::now();
        $mytime=($mytime->toDateString());
        if ($request->from!=null &&$request->to!=null) {
            $start=$request->from;
            $end=$request->to;
        } elseif ($request->from!=null&&$request->to==null) {
            $start=$request->from;
            $end=$mytime;//for the now
            // dd(0);
        } elseif ($request->from==null&&$request->to!=null) {
            $end=$request->to;
            $start=Booking::first()->date;// form  now;
        } else {
            $start=null;
            $end=null;
        }

        if ($start==null&&$end==null) {
            $bookings=Booking::where('status', '1')->where('date', '=', $mytime);
        } else {
            $bookings= Booking::where('date', '>=', $start)
                                    ->where('date', '<=', $end)
                                    ->where('status', '1');
        }
        $bookings=$bookings->get();
        $yValues = array();
        $xValues = array();
        $arr=[];
        foreach ($bookings as $booking) {
            $arr[$booking->date]=$booking->where('date', $booking->date)->sum('book_total_cost');
        }
        foreach ($arr as $key=>$value) {
            $xValues[]=$key;
            $yValues[]=$value;
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['data'] = $arr;
        $output['message'] = "ok";
        $output['code'] = 200;
        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getPaymentsForDays($year, $month)
    {
        self::set_lang();

        $yValues = array();
        $xValues = array();
        for ($i = 1; $i <= 31; $i++) {
            array_push($xValues, $i);
            try {
                array_push($yValues, Booking::whereDate('created_at', $year . "-" . $month . '-' . $i)
                                                    ->where('status', '1')
                                                    ->count());
            } catch (\Exception $e) {
                array_push($yValues, 0);
            }
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['message'] = "ok";
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function limits()
    {
        self::set_lang();

        return view('dashboard.limits.limits', [
            'titleofpage' => __('lang.notification_limit_table'),
        ]);
    }

    public function get_limits(Request $request)
    {
        self::set_lang();

        if ($request->start == 0) {
            $request['page'] = 1;
        } else {
            $request['page'] = ($request->start / $request->length) + 1;
        }

        $query_length = $request['length'];

        $products = DB::select('
            SELECT *
            FROM products
            WHERE notification_limit > (SELECT COUNT(id) from product_options where status = 0 and product_id = products.id)
            AND (SELECT COUNT(id) from product_options where product_id = products.id) != 0
        ');

        $count = sizeof($products);
        $data = $products;
        $data['recordsTotal'] = $count;
        $data['recordsFiltered'] = $count;


        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function general_settings()
    {
        $settings = GeneralSetting::first();

        return view('dashboard.settings', [
            'titleofpage' => __('lang.settings'),
            'settings' => $settings,
        ]);
    }
    public function update_settings(Request $request)
    {
        if ($request->file('file') != null) {
            $Image = $request->file('file');
            if ($Image->getClientOriginalExtension() == "js"  || $Image->getClientOriginalExtension() == "php" || $Image->getClientOriginalExtension() == "sql") {
                session()->flash('danger', 'wrong bad behavoir happend');
            }
            $newImageName = uniqid() . "." . $Image->getClientOriginalExtension();

            $Image->move('images/', $newImageName);

            $image_path = 'images/' . $newImageName;

            $request->logo = $image_path;

            GeneralSetting::where('id', $request->id)->update([
                'logo' => $request->logo,
            ]);
        } else {
            session()->flash('danger', 'wrong bad behavoir happend');
        }

        GeneralSetting::where('id', $request->id)->update([
            'phone' => $request->phone,
            'app_name' => $request->app_name,
            'location_lat' => $request->location,
            'facebook_link' => $request->facebook,
            'whatsapp_link' => $request->whatsapp
        ]);


        return back();
    }

    public function addUsers(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => "required|unique:users,phone",
            'password' => 'required',
            'town_id'=>'required',
            'city'=>'required',
            'phone' => 'required',
            'gender' => 'required',
            'location_lng' => 'required',
            'location_lat' => 'required',
   

        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        //    dd(0);
        $user = new  User;
        // create([
        $user->name = $request['name'];
        $user->phone = $request['phone'];
        $user->image = $request['image'];
        $user->city = $request['city'];
        $user->twon =$request['town_id'] ;
        $user->gender =$request['gender'] ;
        $user->location_lng =$request['location_lng'] ;
        $user->location_lat =$request['location_lat'] ;
        $user->role ='user' ;
        $user->password = bcrypt($request['password']);
        $user->save();
        
        $output['code'] = 200;
        $output["message"] = "added user";

        return response()->json($output, 200);
    }



    public function settings()
    {
        $settings = GeneralSetting::first();

        $output['settings']=$settings;
        $output['message'] = "ok";
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function editUsers(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'phone' => ['required', 'max:255', 'unique:users'.$request['user_id']],
            'town'=>'required',
            'city'=>'required',
            'phone' => 'required',
            'burber_gender' => 'required',
            'location_lng' => 'required',
            'location_lat' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $role=Role::where("id", $request['role'])->first();
        $user = User::where('id', $request['user_id'])->first();
        $user->name = $request['name'];
        $user->role = $role == null ? "user":$role->name;
        $user->phone = $request['phone'];
        $user->image = $request['image'];
        $user->city = $request['city'];
        $user->twon =$request['town'] ;
        $user->location_lng =$request['location_lng'] ;
        $user->location_lat =$request['location_lat'] ;
        $user->gender =$request['burber_gender'];
        if ($request->filled('image')) {
            $user->image =$request['image'];
        }
        $user->save();
        DB::table("model_has_roles")
            ->where("model_id",  $user->id)
            ->where("model_type", "App\Models\User")->delete();
        if($request['role'] != "0"){
            DB::table("model_has_roles")
            ->insert([
                "model_id"=> $user->id, 
                "model_type"=> "App\Models\User",
                "role_id"=> $request['role'],
            ]);
        }
        $output['code'] = 200;
        $output["message"] = "edited user";

        return response()->json($output, 200);
    }

    public function deleteUsers(Request $request)
    {
        $user=User::find($request['user_id']);

        $user->delete();

        $output['code']=200;
        return response()->json($output, 200);
    }

    public function deleteUserImage(Request $request)
    {
        $user=User::find($request['user_id']);

        $user->image='';
        $user->save();
        $output['code']=200;
        return response()->json($output, 200);
    }

    public function getBookingsStatistics(Request $request)
    {
        // dd($request->all());
        $mytime = Carbon::now();
        $mytime=($mytime->toDateString());
        if ($request->from!=null &&$request->to!=null) {
            $start=$request->from;
            $end=$request->to;
        } elseif ($request->from!=null&&$request->to==null) {
            $start=$request->from;
            $end=$mytime;//for the now
            
            // dd($start,$end);
        } elseif ($request->from==null&&$request->to!=null) {
            $end=$request->to;
            $start=$mytime;// form  now;
        } else {
            $start=null;
            $end=null;
        }
        if ($start==null&&$end==null) {
            // dd(0);
            if ($request->status!=null) {
                $bookings= Booking::where('status', $request['status']);
            } else {
                $bookings= Booking::where('date', '=', $mytime);
            }
            if ($request->service!=null) {
                $bookings=$bookings->join('multi_bookings', 'multi_bookings.booking_id', 'bookings.id')
                                    ->where('multi_bookings.service_id', $request['service']);
            }
        } else {
            // dd(0);
            if ($request->status!=null) {
                $bookings= Booking::where('date', '>=', $start)
                                    ->where('date', '<=', $end)
                                    ->where('status', $request['status']);
            //   dd(1);
            } else {
                $bookings= Booking::where('date', '>=', $start)
                                    ->where('date', '<=', $end);
                // dd(0);
            }
            if ($request->service!=null) {
                $bookings=$bookings->join('multi_bookings', 'multi_bookings.booking_id', 'bookings.id')
                                    ->where('multi_bookings.service_id', $request['service']);
                //   dd(2);
            }
        }
        $totalCost=$bookings->sum('bookings.book_total_cost');
        $bookings=$bookings->get();
        $yValues = array();
        $xValues = array();
        $arr=[];
        foreach ($bookings as $booking) {
            $arr[$booking->date]=$booking->where('date', $booking->date)->count();
        }
        foreach ($arr as $key=>$value) {
            $xValues[]=$key;
            $yValues[]=$value;
        }
        $output['rates'] = $yValues;
        $output['days'] = $xValues;
        $output['data'] = $arr;
        $output['totalCost'] = $totalCost;
        $output['message'] = "ok";
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function api_login()
    {
        $output['message'] ="Unauthenticated";
        $output['code'] = 401;

        return response()->json($output, 401, [], JSON_UNESCAPED_UNICODE);
    }

    public function filterAdmin(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'from'=>'required',
            'to'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->josn($validator->errors(), 400);
        }
        $from=$request['from'];
        $to=$request['to'];
        $user=User::where('id', session()->get('user_id'))->first();
        // dd($user->roles);
        $data['users'] = User::where('role', "user")->whereDate('created_at', '>=', $from)
                                                    ->whereDate('created_at', '<=', $to)
                                                    ->count();

        $data['user'] = $user;
        $data['vendors'] = Vendor::whereDate('created_at', '>=', $from)
                                ->whereDate('created_at', '<=', $to)
                                ->count();

        $parent_services = Service::where("parent_service", "0")
                                    ->whereDate('created_at', '>=', $from)
                                    ->whereDate('created_at', '<=', $to);
        $data['services'] =$parent_services->count();

        $data['parent_services'] =Service::join(
            'service_translates',
            'service_translates.service_id',
            'services.id'
        )
                                                    ->where('services.parent_service', '!=', '0')
                                                    ->where('services.special', '!=', '0')
                                                    ->where('service_translates.lang', session()->get('lang'))
                                                    ->whereDate('services.created_at', '>=', $from)
                                                    ->whereDate('services.created_at', '<=', $to)
                                                    ->select('service_translates.name', 'services.id')
                                                    ->get();

        $data['sub_services'] = Service::where("parent_service", "!=", "0")
                                        ->whereDate('created_at', '>=', $from)
                                        ->whereDate('created_at', '<=', $to)
                                        ->count();

        $data['bookings'] = Booking::whereDate('created_at', '>=', $from)
                                    ->whereDate('created_at', '<=', $to)
                                    ->count();

        $data['cancelled_bookings_user'] = Booking::whereDate('created_at', '>=', $from)
                                                    ->whereDate('created_at', '<=', $to)
                                                    ->where('status', '2')
                                                    ->where('status_owner', 'user')
                                                    ->count();

        $data['cancelled_bookings_vendor'] = Booking::whereDate('created_at', '>=', $from)
                                                        ->whereDate('created_at', '<=', $to)
                                                        ->where('status', '2')
                                                        ->where('status_owner', 'vendor')
                                                        ->count();

        $data['completed_bookings_vendor'] = Booking::whereDate('created_at', '>=', $from)
                                                    ->whereDate('created_at', '<=', $to)
                                                    ->where('status', '1')
                                                        ->count();
        $data['notshown_bookings'] = Booking::whereDate('created_at', '>=', $from)
                                                ->whereDate('created_at', '<=', $to)
                                                ->where('status', '3')
                                                ->count();
        $data['pending_bookings'] = Booking::whereDate('created_at', '>=', $from)
                                            ->whereDate('created_at', '<=', $to)
                                            ->where('status', '0')
                                            ->count();
        $data['code']=200;
        return response()->json($data, 200);
    }
}
