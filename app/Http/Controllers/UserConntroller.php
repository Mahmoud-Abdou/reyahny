<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserConntroller extends Controller
{
    public function test(){
        $user=User::first();
        // dd($user->can('users.profile'));
        return view("test", ["user" =>$user ]);
    }
}
