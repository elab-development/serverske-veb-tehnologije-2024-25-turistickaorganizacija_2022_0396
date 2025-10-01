<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Message;
use App\Models\MessageComment;
use App\Mail\Websitemail;

class UserController extends Controller
{
    public function dashboard()
    {
        $total_completed_orders = Booking::where('user_id',Auth::guard('web')->user()->id)->where('payment_status','Completed')->count();
        $total_pending_orders = Booking::where('user_id',Auth::guard('web')->user()->id)->where('payment_status','Pending')->count();
        return view('user.dashboard', compact('total_completed_orders', 'total_pending_orders'));
    }

    public function booking()
    {
        $all_data = Booking::with(['tour','package'])->where('user_id',Auth::guard('web')->user()->id)->get();
        return view('user.booking', compact('all_data'));
    }

    public function invoice($invoice_no)
    {
        $admin_data = Admin::where('id',1)->first();
        $booking = Booking::with(['tour','package'])->where('invoice_no',$invoice_no)->first();
        return view('user.invoice', compact('invoice_no', 'booking', 'admin_data'));
    }

    public function review()
    {
        $reviews = Review::with('package')->where('user_id',Auth::guard('web')->user()->id)->get();
        return view('user.review', compact('reviews'));
    }

    public function wishlist()
    {
        $wishlist = Wishlist::with('package')->where('user_id',Auth::guard('web')->user()->id)->get();
        return view('user.wishlist', compact('wishlist'));
    }

    public function wishlist_delete($id)
    {
        $obj = Wishlist::where('id',$id)->first();
        $obj->delete();
        return redirect()->back()->with('success', 'Stavka sa liste želja je uspešno obrisana!');
    }

    public function message()
    {
        $message_check = Message::where('user_id',Auth::guard('web')->user()->id)->count();
        $message = Message::where('user_id',Auth::guard('web')->user()->id)->first();
        
        if($message) {
            $message_comments = MessageComment::where('message_id',$message->id)->orderBy('id','desc')->get();
        } else {
            $message_comments = [];
        }

        return view('user.message', compact('message_check', 'message_comments'));
    }

    public function message_start()
    {
        $message_check = Message::where('user_id',Auth::guard('web')->user()->id)->count();
        if($message_check > 0) {
            return redirect()->back()->with('error', 'Već ste započeli konverzaciju!');
        }

        $obj = new Message;
        $obj->user_id = Auth::guard('web')->user()->id;
        $obj->save();
        
        return redirect()->back()->with('success', 'Konverzacija je započeta.');
    }

    public function message_submit(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'Molimo unesite poruku.',
        ]);

        $message = Message::where('user_id',Auth::guard('web')->user()->id)->first();

        $obj = new MessageComment;
        $obj->message_id = $message->id;
        $obj->sender_id = Auth::guard('web')->user()->id;
        $obj->type = 'User';
        $obj->comment = $request->comment;
        $obj->save();

        $message_link = route('admin_message_detail',$message->id);
        $subject = 'Nova poruka korisnika';
        $emailBody = 'Kliknite na sledeći link da vidite novu poruku od korisnika:<br><a href="'.$message_link.'">Otvorite poruku</a>';

        $admin_data = Admin::where('id',1)->first();

        \Mail::to($admin_data->email)->send(new Websitemail($subject,$emailBody));

        return redirect()->back()->with('success', 'Poruka je uspešno poslata!');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profile_submit(Request $request)
    {
        $user = User::where('id',Auth::guard('web')->user()->id)->first();

        // Validacija sa porukama na srpskom
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email|unique:users,email,'.$user->id,
            'phone'   => 'required',
            'country' => 'required',
            'address' => 'required',
            'state'   => 'required',
            'city'    => 'required',
            'zip'     => 'required',
        ], [
            'name.required'    => 'Ime i prezime je obavezno.',
            'email.required'   => 'Email adresa je obavezna.',
            'email.email'      => 'Unesite ispravnu email adresu.',
            'email.unique'     => 'Ova email adresa je već zauzeta.',
            'phone.required'   => 'Broj telefona je obavezan.',
            'country.required' => 'Država je obavezna.',
            'address.required' => 'Adresa je obavezna.',
            'state.required'   => 'Pokrajina/Regija je obavezna.',
            'city.required'    => 'Grad je obavezan.',
            'zip.required'     => 'ZIP kod je obavezan.',
        ]);

        if($request->photo) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'photo.image' => 'Odabrani fajl mora biti slika.',
                'photo.mimes' => 'Dozvoljeni formati su: jpeg, png, jpg, gif, svg.',
                'photo.max'   => 'Maksimalna veličina fotografije je 2MB.',
            ]);

            if($user->photo != '') {
                @unlink(public_path('uploads/'.$user->photo));
            }
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        if($request->password != '') {
            $request->validate([
                'password'        => 'required',
                'retype_password' => 'required|same:password',
            ], [
                'password.required'        => 'Lozinka je obavezna.',
                'retype_password.required' => 'Potvrda lozinke je obavezna.',
                'retype_password.same'     => 'Lozinke se ne poklapaju.',
            ]);
            $user->password = bcrypt($request->password);
        }
        
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->state   = $request->state;
        $user->city    = $request->city;
        $user->zip     = $request->zip;
        $user->save();

        return redirect()->back()->with('success', 'Profil je uspešno ažuriran!');
    }
}
