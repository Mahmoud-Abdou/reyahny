<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Category;
use App\Group;
use App\Language;
use App\GroupTranslates;
use App\Order;
use App\Product;
use App\ProductTranslates;
use App\User;
use App\UserDetails;
use Validator;
use DB;

class ProfileController extends Controller
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

   
        $user_id = session()->get('user_id');

        $user = User::find($user_id);


        return view('dashboard.profile.index', [
        'titleofpage' =>__('lang.profile'),
        'user' => $user
    ]);
    }

    public function save(Request $request)
    {
        self::set_lang();

        request()->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'required',
        'password' => 'nullable',
        'name'=>"required",
    ]);

        $user_id = session()->get('user_id');

        if ($request->hasFile('image')) {


        // Get file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        
            // Upload Image
            $path = $request->file('image')->storeAs('public/profiles', $fileNameToStore);

            $request->image = $fileNameToStore;

            User::where('id', $user_id)->update([
            'image' => $request->image
    ]);
        }

   

        User::where('id', $user_id)->update([
        'email' => $request->email,
    ]);


        if ($request->password) {
            User::where('id', $user_id)->update([
            'password' => bcrypt($request->password),
        ]);
        }
        if ($request->name) {
            User::where('id', $user_id)->update([
            'name' => ($request->name),
        ]);
        }

        return redirect('profile');
    }
}
