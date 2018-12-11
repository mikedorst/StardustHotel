<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
	
	public function login(Request $request)
	{
		
		$this->validate($request, [
		  'email'   => 'required|email',
		  'password'  => 'required|alphaNum|min:3'
		 ]);
		 
		 $users = User::get();
		 
		 $users = array(
		  'email'  => $request->get('email'),
		  'password' => $request->get('password')
		 );
		
		if(Auth::attempt($users))
		{
		  return redirect('login');
		}
		else
		{
		  return back()->with('error', 'Wrong Login Details');
		}
	}

}
