<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;
use App\Mail\Websitemail;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.required'    => 'Email adresa je obavezna.',
            'email.email'       => 'Unesite ispravnu email adresu.',
            'password.required' => 'Lozinka je obavezna.',
        ]);
    
        $check = $request->all();
        $data = [
            'email'    => $check['email'],
            'password' => $check['password']
        ];
    
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with('success','Uspešno ste se prijavili!');
        } else {
            return redirect()->route('admin_login')->with('error','Podaci koje ste uneli nisu tačni! Pokušajte ponovo.');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success','Uspešno ste se odjavili!');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name'  => ['required'],
            'email' => ['required', 'email'],
        ],[
            'name.required'  => 'Ime je obavezno.',
            'email.required' => 'Email adresa je obavezna.',
            'email.email'    => 'Unesite ispravnu email adresu.',
        ]);

        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        if ($request->photo) {
            $request->validate([
                'photo' => ['mimes:jpg,jpeg,png,gif', 'max:2024'],
            ],[
                'photo.mimes' => 'Dozvoljeni formati slike su: jpg, jpeg, png, gif.',
                'photo.max'   => 'Maksimalna veličina slike je 2MB.',
            ]);

            $final_name = 'admin_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);

            // Bezbedno brisanje stare slike samo ako postoji
            if (!empty($admin->photo)) {
                $oldPath = public_path('uploads/'.$admin->photo);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $admin->photo = $final_name;
        }

        if ($request->password) {
            $request->validate([
                'password'         => ['required'],
                'confirm_password' => ['required','same:password'],
            ],[
                'password.required'          => 'Lozinka je obavezna.',
                'confirm_password.required'  => 'Potvrda lozinke je obavezna.',
                'confirm_password.same'      => 'Lozinke se ne poklapaju.',
            ]);
            $admin->password = Hash::make($request->password);
        }
        
        $admin->name  = $request->name;
        $admin->email = $request->email;
        $admin->update();

        return redirect()->back()->with('success','Profil je uspešno ažuriran!');
    }

    public function forget_password()
    {
        return view('admin.forget-password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ],[
            'email.required' => 'Email adresa je obavezna.',
            'email.email'    => 'Unesite ispravnu email adresu.',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with('error','Email adresa nije pronađena!');
        }

        $token = hash('sha256', time());
        $admin->token = $token;
        $admin->update();

        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = "Resetovanje lozinke";
        $message = "Za resetovanje lozinke kliknite na sledeći link:<br>";
        $message .= "<a href='".$reset_link."'>Kliknite ovde</a>";

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with(
            'success',
            'Poslali smo vam link za resetovanje lozinke. Proverite email. Ako poruku ne vidite u pristigloj pošti, proverite spam folder.'
        );
    }

    public function reset_password($token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin) {
            return redirect()->route('admin_login')->with('error','Token ili email nije ispravan!');
        }
        return view('admin.reset-password', compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password'         => ['required'],
            'confirm_password' => ['required','same:password'],
        ],[
            'password.required'         => 'Lozinka je obavezna.',
            'confirm_password.required' => 'Potvrda lozinke je obavezna.',
            'confirm_password.same'     => 'Lozinke se ne poklapaju.',
        ]);

        $admin = Admin::where('email', $request->email)->where('token', $request->token)->first();
        if (!$admin) {
            return redirect()->route('admin_login')->with('error','Token ili email nije ispravan!');
        }

        $admin->password = Hash::make($request->password);
        $admin->token = "";
        $admin->update();

        return redirect()->route('admin_login')->with('success','Lozinka je uspešno resetovana. Sada se možete prijaviti.');
    }
}
