<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\Admin; // za spoljni ključ

class AdminTeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $q = TeamMember::query();

        // Pretraga po imenu, poziciji, emailu, telefonu
        if ($search = $request->get('q')) {
            $q->where(function ($w) use ($search) {
                $w->where('name', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filtriranje po adminu
        if ($adminId = $request->get('admin_id')) {
            $q->where('admin_id', $adminId);
        }

        $team_members = $q->orderBy('id', 'desc')->paginate(10)->withQueryString();
        $admins = Admin::select('id','name')->orderBy('name')->get();

        return view('admin.team_member.index', compact('team_members','admins'));
    }

    public function create()
    {
        $admins = Admin::select('id','name')->orderBy('name')->get();
        return view('admin.team_member.create', compact('admins'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'slug'        => 'required|alpha_dash|unique:team_members,slug',
            'designation' => 'required',
            'email'       => 'required|email',
            'phone'       => 'required',
            'address'     => 'required',
            'photo'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nickname'    => 'nullable|string|max:255',
            'admin_id'    => 'nullable|exists:admins,id',
        ], [
            'name.required'        => 'Ime je obavezno.',
            'slug.required'        => 'Slug je obavezan.',
            'slug.alpha_dash'      => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'          => 'Ovaj slug je već zauzet.',
            'designation.required' => 'Pozicija je obavezna.',
            'email.required'       => 'Email adresa je obavezna.',
            'email.email'          => 'Unesite važeću email adresu.',
            'phone.required'       => 'Telefon je obavezan.',
            'address.required'     => 'Adresa je obavezna.',
            'photo.required'       => 'Fotografija je obavezna.',
            'photo.image'          => 'Datoteka mora biti slika.',
            'photo.mimes'          => 'Dozvoljeni formati su: jpeg, png, jpg, gif, svg.',
            'photo.max'            => 'Maksimalna veličina fotografije je 2MB.',
            'nickname.max'         => 'Nadimak je predugačak.',
            'admin_id.exists'      => 'Izabrani administrator ne postoji.',
        ]);

        $final_name = 'team_member_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new TeamMember();
        $obj->photo       = $final_name;
        $obj->name        = $request->name;
        $obj->slug        = $request->slug;
        $obj->designation = $request->designation;
        $obj->email       = $request->email;
        $obj->phone       = $request->phone;
        $obj->address     = $request->address;
        $obj->biography   = $request->biography;
        $obj->facebook    = $request->facebook;
        $obj->linkedin    = $request->linkedin;
        $obj->instagram   = $request->instagram;
        $obj->nickname    = $request->nickname;
        $obj->admin_id    = $request->admin_id;
        $obj->save();

        return redirect()->route('admin_team_member_index')->with('success', 'Član tima je uspešno kreiran!');
    }

    public function edit($id)
    {
        $team_member = TeamMember::where('id', $id)->firstOrFail();
        $admins = Admin::select('id','name')->orderBy('name')->get();
        return view('admin.team_member.edit', compact('team_member','admins'));
    }

    public function edit_submit(Request $request, $id)
    {
        $team_member = TeamMember::where('id', $id)->firstOrFail();
        
        $request->validate([
            'name'        => 'required',
            'slug'        => 'required|alpha_dash|unique:team_members,slug,'.$team_member->id,
            'designation' => 'required',
            'email'       => 'required|email',
            'phone'       => 'required',
            'address'     => 'required',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nickname'    => 'nullable|string|max:255',
            'admin_id'    => 'nullable|exists:admins,id',
        ], [
            'name.required'        => 'Ime je obavezno.',
            'slug.required'        => 'Slug je obavezan.',
            'slug.alpha_dash'      => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'          => 'Ovaj slug je već zauzet.',
            'designation.required' => 'Pozicija je obavezna.',
            'email.required'       => 'Email adresa je obavezna.',
            'email.email'          => 'Unesite važeću email adresu.',
            'phone.required'       => 'Telefon je obavezan.',
            'address.required'     => 'Adresa je obavezna.',
            'photo.image'          => 'Datoteka mora biti slika.',
            'photo.mimes'          => 'Dozvoljeni formati su: jpeg, png, jpg, gif, svg.',
            'photo.max'            => 'Maksimalna veličina fotografije je 2MB.',
            'nickname.max'         => 'Nadimak je predugačak.',
            'admin_id.exists'      => 'Izabrani administrator ne postoji.',
        ]);

        if($request->hasFile('photo')) {
            if(!empty($team_member->photo) && file_exists(public_path('uploads/'.$team_member->photo))) {
                @unlink(public_path('uploads/'.$team_member->photo));
            }
            $final_name = 'team_member_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $team_member->photo = $final_name;
        }
        
        $team_member->name        = $request->name;
        $team_member->slug        = $request->slug;
        $team_member->designation = $request->designation;
        $team_member->address     = $request->address;
        $team_member->email       = $request->email;
        $team_member->phone       = $request->phone;
        $team_member->biography   = $request->biography;
        $team_member->facebook    = $request->facebook;
        $team_member->linkedin    = $request->linkedin;
        $team_member->instagram   = $request->instagram;
        $team_member->nickname    = $request->nickname;
        $team_member->admin_id    = $request->admin_id;
        $team_member->save();

        return redirect()->route('admin_team_member_index')->with('success', 'Član tima je uspešno ažuriran!');
    }

    public function delete($id)
    {
        $team_member = TeamMember::where('id', $id)->firstOrFail();

        if(!empty($team_member->photo) && file_exists(public_path('uploads/'.$team_member->photo))) {
            @unlink(public_path('uploads/'.$team_member->photo));
        }

        $team_member->delete();

        return redirect()->route('admin_team_member_index')->with('success', 'Član tima je uspešno obrisan!');
    }
}
