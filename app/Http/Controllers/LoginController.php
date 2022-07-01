<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        $user = User::where(['email' => $request->email])->first();


        if (!$user || !Hash::check($request->password, $user->password)) {

            Alert::error('Oops', 'Please trt again');
            return redirect()->back();

        } else {
            $request->session()->put('user', $user);
            Alert::success('Success', ' You have login Successful');
            return redirect('/sms');

        }
    }
}
