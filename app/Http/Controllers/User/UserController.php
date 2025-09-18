<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserController extends Controller
{
      public function dashboard()
    {
        return view('user.dashboard');
    }
    public function profile(){
        return view('user.profile');
    }

    public function profile_submit(Request $request)
    {
        $user = User::where('id',Auth::guard('web')->user()->id)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'country' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);

        if($request->photo) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if($user->photo != '') {
                unlink(public_path('uploads/'.$user->photo));
            }
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        if($request->password != '') {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password',
            ]);
            $user->password = bcrypt($request->password);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
  
}
