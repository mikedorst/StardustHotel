<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
	
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
           'firstname' => 'required|string',
           'lastname' => 'required|string',
           'email' => 'required|email',
           'address' => 'required|string',
           'country' => 'required|string',
           'phone' => 'required|int',
           'username' => 'required|string',
           'password' => 'required|string',
       ]);
        
       if ($validator->fails()) {
            return redirect()->back()->with('error', 'Niet alle velden zijn ingevuld! Probeer opnieuw.'); 
       }
	   
	   $user = User::where('username', $request->username)->first();
	   
		if($user != null)
		{		
			return redirect()->back()->with('error', 'Gebruikernaam al in gebruik');
		}else{	
			$user = new User();
			$user->username = $request->username;
			$user->password = hash('sha512', $request->password);
			$user->save();
			
			$currentUser = User::where('username', $request->username)->first();
			
			$c = new Customer();
			$c->firstname = $request->firstname;
			$c->lastname = $request->lastname;
			$c->email = $request->email;
			$c->address = $request->address;
			$c->country = $request->country;
			$c->phone = $request->phone;
			$c->user_id = $currentUser->id;
			$c->save();
		}	
	}

}
