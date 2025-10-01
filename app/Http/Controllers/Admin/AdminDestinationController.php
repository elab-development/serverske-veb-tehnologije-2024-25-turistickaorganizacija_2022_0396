<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;

class AdminDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::get();
        return view('admin.destination.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destination.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name'           => 'required|unique:destinations',
            'slug'           => 'required|alpha_dash|unique:destinations',
            'description'    => 'required',
            'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'name.required'            => 'Naziv destinacije je obavezan.',
            'name.unique'              => 'Naziv destinacije već postoji.',
            'slug.required'            => 'Slug je obavezan.',
            'slug.alpha_dash'          => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'              => 'Ovaj slug već postoji.',
            'description.required'     => 'Opis je obavezan.',
            'featured_photo.required'  => 'Naslovna fotografija je obavezna.',
            'featured_photo.image'     => 'Morate otpremiti validnu sliku.',
            'featured_photo.mimes'     => 'Dozvoljeni formati: jpeg, png, jpg, gif, svg.',
            'featured_photo.max'       => 'Maksimalna veličina slike je 2MB.',
        ]);

        $final_name = 'destination_featured_'.time().'.'.$request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);

        $obj = new Destination();
        $obj->featured_photo  = $final_name;
        $obj->name            = $request->name;
        $obj->slug            = $request->slug;
        $obj->description     = $request->description;
        $obj->country         = $request->country;
        $obj->language        = $request->language;
        $obj->currency        = $request->currency;
        $obj->area            = $request->area;
        $obj->timezone        = $request->timezone;
        $obj->visa_requirement= $request->visa_requirement;
        $obj->activity        = $request->activity;
        $obj->best_time       = $request->best_time;
        $obj->health_safety   = $request->health_safety;
        $obj->map             = $request->map;
        $obj->view_count      = 1;
        $obj->save();

        return redirect()->route('admin_destination_index')->with('success','Destinacija je uspešno kreirana.');
    }

    public function edit($id)
    {
        $destination = Destination::where('id',$id)->first();
        return view('admin.destination.edit', compact('destination'));
    }
    
    public function edit_submit(Request $request, $id)
    {
        $destination = Destination::where('id',$id)->first();
        
        $request->validate([
            'name'        => 'required|unique:destinations,name,'.$id,
            'slug'        => 'required|alpha_dash|unique:destinations,slug,'.$id,
            'description' => 'required',
        ],[
            'name.required'        => 'Naziv destinacije je obavezan.',
            'name.unique'          => 'Naziv destinacije već postoji.',
            'slug.required'        => 'Slug je obavezan.',
            'slug.alpha_dash'      => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'          => 'Ovaj slug već postoji.',
            'description.required' => 'Opis je obavezan.',
        ]);

        if ($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'featured_photo.required' => 'Naslovna fotografija je obavezna.',
                'featured_photo.image'    => 'Morate otpremiti validnu sliku.',
                'featured_photo.mimes'    => 'Dozvoljeni formati: jpeg, png, jpg, gif, svg.',
                'featured_photo.max'      => 'Maksimalna veličina slike je 2MB.',
            ]);

            // Bezbedno brisanje stare slike
            if (!empty($destination->featured_photo)) {
                $old = public_path('uploads/'.$destination->featured_photo);
                if (is_file($old)) {
                    @unlink($old);
                }
            }

            $final_name = 'destination_featured_'.time().'.'.$request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $destination->featured_photo = $final_name;
        }
        
        $destination->name            = $request->name;
        $destination->slug            = $request->slug;
        $destination->description     = $request->description;
        $destination->country         = $request->country;
        $destination->language        = $request->language;
        $destination->currency        = $request->currency;
        $destination->area            = $request->area;
        $destination->timezone        = $request->timezone;
        $destination->visa_requirement= $request->visa_requirement;
        $destination->activity        = $request->activity;
        $destination->best_time       = $request->best_time;
        $destination->health_safety   = $request->health_safety;
        $destination->map             = $request->map;
        $destination->save();

        return redirect()->route('admin_destination_index')->with('success','Destinacija je uspešno izmenjena.');
    }

    public function delete($id)
    {
        $totalPhotos = DestinationPhoto::where('destination_id',$id)->count();
        if ($totalPhotos > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve fotografije povezane sa ovom destinacijom.');
        }

        $totalVideos = DestinationVideo::where('destination_id',$id)->count();
        if ($totalVideos > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve video zapise povezane sa ovom destinacijom.');
        }

        $destination = Destination::where('id',$id)->first();

        // Bezbedno brisanje fajla
        if (!empty($destination->featured_photo)) {
            $path = public_path('uploads/'.$destination->featured_photo);
            if (is_file($path)) {
                @unlink($path);
            }
        }

        $destination->delete();
        return redirect()->route('admin_destination_index')->with('success','Destinacija je uspešno obrisana.');
    }

    public function destination_photos($id)
    {
        $destination = Destination::where('id',$id)->first();
        $destination_photos = DestinationPhoto::where('destination_id',$id)->get();
        return view('admin.destination.photos', compact('destination', 'destination_photos'));
    }

    public function destination_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'photo.required' => 'Fotografija je obavezna.',
            'photo.image'    => 'Morate otpremiti validnu sliku.',
            'photo.mimes'    => 'Dozvoljeni formati: jpeg, png, jpg, gif, svg.',
            'photo.max'      => 'Maksimalna veličina slike je 2MB.',
        ]);

        $final_name = 'destination_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new DestinationPhoto;
        $obj->destination_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success','Fotografija je uspešno dodata.');
    }

    public function destination_photo_delete($id)
    {
        $destination_photo = DestinationPhoto::where('id',$id)->first();

        if (!empty($destination_photo->photo)) {
            $path = public_path('uploads/'.$destination_photo->photo);
            if (is_file($path)) {
                @unlink($path);
            }
        }

        $destination_photo->delete();
        return redirect()->back()->with('success','Fotografija je uspešno obrisana.');
    }

    public function destination_videos($id)
    {
        $destination = Destination::where('id',$id)->first();
        $destination_videos = DestinationVideo::where('destination_id',$id)->get();
        return view('admin.destination.videos', compact('destination', 'destination_videos'));
    }

    public function destination_video_submit(Request $request, $id)
    {
        $request->validate([
            'video' => 'required',
        ],[
            'video.required' => 'YouTube ID videa je obavezan.',
        ]);

        $obj = new DestinationVideo;
        $obj->destination_id = $id;
        $obj->video = $request->video;
        $obj->save();

        return redirect()->back()->with('success','Video je uspešno dodat.');
    }

    public function destination_video_delete($id)
    {
        $destination_video = DestinationVideo::where('id',$id)->first();
        $destination_video->delete();
        return redirect()->back()->with('success','Video je uspešno obrisan.');
    }
}
