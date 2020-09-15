<?php

namespace App\Http\Controllers;

use App\Doc;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function profile()
    {
        return view('profile', [
            'my_docs' => Doc::where('user_id', Auth::user()->id)->where('type', 0)->get(),
            'my_orders' => Doc::where('user_id', Auth::user()->id)->where('type', 1)->get()
        ]);
    }

    public function auth(Request $request)
    {
        if (!$user = User::find($request['uid'])) {
            $user = new User();
            $user->id = $request['uid'];
        }
        
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->photo = $request['photo'];
        $user->photo_rec = $request['photo_rec'];
        $user->hash = $request['hash'];
        $user->save();

        Auth::login(User::find($request['uid']));
        return redirect('/');
    }

    public function setPrivate(Request $request)
    {
        Auth::user()->is_private = $request['private'] === 'true' ? 1 : 0;
        Auth::user()->save();
    }
}
