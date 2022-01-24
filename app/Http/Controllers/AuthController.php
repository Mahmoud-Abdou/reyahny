<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Trader;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Carbon\Carbon;
use App;
use Illuminate\Support\Str;
use App\Vendor;
use App\Reviews;
use App\Message;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    
    //period for auth_token
    private $ttl = 20160;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgetPassword', 'resetCode', 'resetPassword']]);
    }

    private function generateAccessToken($accountId, $email)
    {
        $access_token = "";
        $secretKey = Config("app.key");
        $secretIv = Config("app.key");
        $encryptMethod = "AES-256-CBC";
        $signature = hash('sha256', $secretKey);
        $iv = substr(hash('sha256', $secretIv), 0, 16);

        $header = [
            "alg" => "sha256",
            "typ" => "JWT",
        ];

        $payload = [
            "user_id" => $accountId,
            "user_email" => $email,
            "creation_ttl_date" => Carbon::now('UTC')->timestamp,
            "expire_ttl_date" => Carbon::now('UTC')->addMinute($this->ttl)->timestamp,
            "creation_refrech_ttl_date" => "",
            "expire_refrech_ttl_date" => "",
        ];

        $encryptedHeader = base64_encode(openssl_encrypt(json_encode($header), $encryptMethod, $signature, 0, $iv));

        $encryptedPayload = base64_encode(openssl_encrypt(json_encode($payload), $encryptMethod, $signature, 0, $iv));
        $access_token = $encryptedHeader . "." . $encryptedPayload . "." . $signature;

        return $access_token;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $credentials = request(['email', 'password']);
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user=User::findOrFail(auth()->user()->id);
        if ($request->header('token')) {
            $user->fcm=$request->header('token');
            $user->save();
        }
        $output['access_token'] = $token;
        $output['token_type'] = 'bearer';
        $output['expires_in'] =600 * 600000000000000000000;
        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $user;
        return response()->json($output, 200);
    }
    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phone' => 'required',
            'gender' => 'required',
            'role' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $credentials = request(['name', 'email', 'phone', 'password', 'gender','role']);
        $user = new  User();
        $user->email = $credentials['email'];
        $user->name = $credentials['name'];
        $user->phone = $credentials['phone'];
        $user->password = bcrypt($credentials['password']);
        $user->gender = $credentials['gender'];
        $user->role = $credentials['role'];
        $user->fcm=$request->header('token');
        $user->location_lat=$request->location_lat;
        $user->location_lng=$request->location_lng;
        $user->save();

      
        return self::login($request);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user=User::where('id', (auth()->user()->id))->first();
        $user->fcm='';
        $user->save();
        auth()->logout();


        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = User::find(auth()->user()->id);

        $output['access_token'] = $token;
        $output['token_type'] = 'bearer';
        $output['expires_in'] = auth()->factory()->getTTL() * 600000000000000000000;
        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $user;

        return response()->json([ $output , 200, [], JSON_UNESCAPED_UNICODE ]);
    }

    public function payload()
    {
        return auth()->payload();
    }
    public function forgetPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone' => 'required',

        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            $output['message'] = 'no such phone';
            $output['code'] = 200;
            $output['data'] = $user;

            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }

        $reset_code = self::generateResetCode();

        User::where('phone', $request->phone)->update([
            'reset_code' => $reset_code
       ]);


        $msg = "Your password reset code is " . $reset_code;

        // use wordwrap() if lines are longer than 70 characters
        // $message=new Message();
        // $message->sendSMS($user->phone, $msg);
        // $msg = wordwrap($msg,70);

        // send email
        // mail($request->email ,"Lusher password reset",$msg);

        $output['message'] = true;
        $output['code'] = 200;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function generateResetCode()
    {
        $str='';
        // for ($i=0;$i<6;$i++) {
        //     $str=$str.rand(1, 9);
        // }
        // return $str;
        return "123456";
    }
    public function resetCode(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'reset_code' => 'required',

        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $user = User::where('reset_code', $request->reset_code)->first();

        if (!$user) {
            $output['message'] = 'this code is not matching with our records';
            $output['code'] = 200;
            $output['data'] = $user;

            return response()->json([ $output , 200, [], JSON_UNESCAPED_UNICODE ]);
        }

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $user;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function resetPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'reset_code' => 'required',
            'password' => 'required',
            'phone' => 'required',

        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }

        $user = User::where('reset_code', $request->reset_code)
                        ->where('phone', $request->phone)
                        ->update([
                            'password' => bcrypt($request->password)
                        ]);

        $output['message'] = true;
        $output['code'] = 200;
        $output['data'] = $user;

        return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function NotAuthorized()
    {
        # code...
        
        $output['message'] = false;
        $output['code'] = 401;
        $output['data'] = "not authorized";

        return response()->json([ $output , 401, [], JSON_UNESCAPED_UNICODE ]);
    }

    public function redirectTo(Request $request)
    {
        $mapUrl=MapUrl::where('url', $request['url'])->first();
        if ($mapUrl!=null) {
            return redirect($mapUrl->url);
        }
        $output['code']=404;
        $output['message']="this link not valid";
        return response()->json($output, 404);
    }

    public function social_login(Request $request)
    {
        dd("sad");
        $validation= Validator::make($request->all(), [
            'email'=>'required',
            "username"=>'required',
            "id"=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
 
        $request['password'] = $request['id'];
        $user = User::where('email', $request['email'])->first();
        if ($user != null) {
            return self::login($request);
        }
        $user = new User([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();

        return self::login($request);

      
        if ($new_user_trans->save()) {
            $output['message'] = true;
            $output['code'] = 200;
            $output['data'] = 'Thanks for registeration';
            return response()->json($output, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            $output['message'] = false;
            $output['code'] = 400;
            $output['data'] = 'Something went wrong';
            return response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
