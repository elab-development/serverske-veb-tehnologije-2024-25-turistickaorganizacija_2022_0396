<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use Hash;

class FrontController extends Controller
{
    public function home(){
        return view('front.home');
    }
    public function about(){
        return view('front.about');
    }
    public function registration(){
        return view('front.registration');
    }
    public function registration_submit(Request $request){
     
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        $token = hash('sha256',time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token = $token;
        $user->save();

        $verification_link = route('registration_verify',['email'=>$request->email,'token'=>$token]);

        $subject = 'User Account Verification';
        $message = 'Please click the following link to verify your email address:<br><a href="'.$verification_link.'">Verify Email</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Registration is Successful, but you have to verify your email address to login. So please check your email to confirm the verification link.');
    
    }

    public function registration_verify($email,$token)
    {
        //dd($token,$email);
        $user = User::where('token',$token)->where('email',$email)->first();
        if(!$user) {
            return redirect()->route('login');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success', 'Your email is verified. You can login now.');
    }

    public function login(){
        return view('front.login');
    }
     public function forget_password(){
        return view('front.forget_password');
    }
}
