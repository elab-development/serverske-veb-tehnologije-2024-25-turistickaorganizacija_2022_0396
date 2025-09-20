<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Slider;
use App\Models\WelcomeItem;
use App\Models\Feature;
use App\Models\CounterItem;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Faq;
use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
use App\Models\Package;
use App\Models\PackageAmenity;
use App\Models\PackageItinerary;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PackageFaq;
use App\Models\Amenity;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Subscriber;
use App\Models\HomeItem;
use App\Models\AboutItem;
use App\Models\ContactItem;
use App\Models\TermPrivacyItem;
use App\Mail\Websitemail;
use Hash;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontController extends Controller
{
    public function home(){
        $sliders = Slider::get();
        $welcome_item = WelcomeItem::where('id',1)->first();
        $features = Feature::get();
        $testimonials = Testimonial::get();
        return view('front.home',  compact('sliders', 'welcome_item', 'features', 'testimonials'));
    }
    public function about(){
        $welcome_item = WelcomeItem::where('id',1)->first();
        $features = Feature::get();
        $counter_item = CounterItem::where('id',1)->first();
        return view('front.about', compact('welcome_item', 'features','counter_item'));
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
        public function login_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];
    
        if(Auth::guard('web')->attempt($data)) {
            return redirect()->route('user_dashboard')->with('success','Login is successful!');
        } else {
            return redirect()->route('login')->with('error','The information you entered is incorrect! Please try again!')->withInput();
        }
    }
   
      public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('succes','Logout is succeful!');
    }
    
    public function forget_password()
    {
        return view('front.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error','Email is not found!');
        }

        $token = hash('sha256',time());
        $user->token = $token;
        $user->update();

        $reset_link = route('reset_password',['token'=>$token,'email'=>$request->email]);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='".$reset_link."'>Click Here</a>";

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','We have sent a password reset link to your email');
    }

    public function reset_password($token,$email)
    {
        $user = User::where('email',$email)->where('token',$token)->first();
        if(!$user) {
            return redirect()->route('login')->with('error','Token or email is not correct!');
        }
        return view('front.reset_password', compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required'],
            'retype_password' => ['required','same:password'],
        ]);

        $user = User::where('email',$request->email)->where('token',$request->token)->first();
        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return redirect()->route('login')->with('success','Password reset is successful. You can login now.');
    }
    public function team_members()
    {
        $team_members = TeamMember::paginate(4);
        return view('front.team_members', compact('team_members'));
    }
    public function team_member($slug)
    {
        $team_member = TeamMember::where('slug',$slug)->first();
        return view('front.team_member', compact('team_member'));
    } 
    public function faq()
    {
        $faqs = Faq::get();
        return view('front.faq', compact('faqs'));
    }


}
