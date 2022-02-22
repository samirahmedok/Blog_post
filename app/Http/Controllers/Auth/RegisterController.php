<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\verifyUser;
use App\Mail\verifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $verifyUser = new verifyUser();
        $verifyUser->user_id = $user->id;
        $verifyUser->token =Str::random(50);
        $verifyUser->save();

        //Send it to the user via  email
        Mail::to($user->email)->send(new verifyEmail($user));

        return $user;

        
    }
    protected function registered(request $request, $user)
    {
        $this->guard()->logout();
        return redirect('login')->with('success' , 'account regitered but you must verify your email first and login');
    }

    public function verifyEmail($token)
    {
        $verifyUser = verifyUser::where('token' , $token)->firstOrFail();

        if($verifyUser->user->verified)
        {
            return redirect('login')->with('error' , 'This account has already verified');

        }else
        {
            $verifyUser->user->verified = true;
            $verifyUser->user->save();
            return redirect('login')->with('success' , 'Email verified, you can login now');
        }
    }
}
