<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Events\RegisterUser;
use Toastr;
use Illuminate\Support\Facades\Auth;

use function Psy\sh;

class CustomerController extends Controller
{
    public function register(RegistrationRequest $request){
        
        $user = new User();
        $user->f_name = $request->first_name;
        $user->l_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        event(new RegisterUser($user));

        Toastr::success('You have registered successfully. Verification link has been sent to your email.');
        return redirect()->route('login');
    }

    public function login(LoginRequest $request){

        $credentials = $request->only('email', 'password');

        // Check credentials
        if (Auth::validate($credentials)) {
            $user = User::where('email', $request->email)->first();
    
            // Check if email is verified
            if ($user->email_verified_at === null) {
                Toastr::error('You must verify your email before logging in.');
                return redirect()->back()->withInput();
            }
    
            // If verified, log in
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }

        Toastr::error('Invalid credentials.');
        return redirect()->back()->withInput();
    }

    public function verify($id, $hash){
        
        $user = User::find($id);

        if($user->email_verified_at != null){
            Toastr::success('Your email has already been verified. Please log in to continue.');
            return redirect()->route('login');
        }
        if(sha1($user->email.'test') == $hash){

            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            Toastr::success('Your email has been verified. Now you can login.');
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }

    public function logout(){

        Auth::logout();
        
        Toastr::success('You have been logged out.');
        return redirect()->route('login');
    }
}
