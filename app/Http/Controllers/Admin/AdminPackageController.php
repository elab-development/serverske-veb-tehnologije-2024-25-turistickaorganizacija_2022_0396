<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Amenity;
use App\Models\PackageAmenity;
use App\Models\PackageItinerary;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PackageFaq;
use App\Models\Tour;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::get();
        return view('admin.package.index',compact('packages'));
    }

    public function create()
    {
        $destinations = Destination::orderBy('name','asc')->get();
        return view('admin.package.create', compact('destinations'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name'           => 'required|unique:packages',
            'slug'           => 'required|alpha_dash|unique:packages',
            'description'    => 'required',
            'price'          => 'required|numeric',
            'old_price'      => 'numeric',
            'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'name.required'           => 'Naziv paketa je obavezan.',
            'name.unique'             => 'Ovaj naziv paketa već postoji.',
            'slug.required'           => 'Slug je obavezan.',
            'slug.alpha_dash'         => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'             => 'Ovaj slug već postoji.',
            'description.required'    => 'Opis je obavezan.',
            'price.required'          => 'Cena je obavezna.',
            'price.numeric'           => 'Cena mora biti broj.',
            'old_price.numeric'       => 'Stara cena mora biti broj.',
            'featured_photo.required' => 'Istaknuta fotografija je obavezna.',
            'featured_photo.image'    => 'Istaknuta fotografija mora biti slika.',
            'featured_photo.mimes'    => 'Dozvoljeni formati su: jpeg, png, jpg, gif, svg.',
            'featured_photo.max'      => 'Maksimalna veličina slike je 2MB.',
            'banner.required'         => 'Baner je obavezan.',
            'banner.image'            => 'Baner mora biti slika.',
            'banner.mimes'            => 'Dozvoljeni formati banera: jpeg, png, jpg, gif, svg.',
            'banner.max'              => 'Maksimalna veličina banera je 2MB.',
        ]);

        $final_name = 'package_featured_'.time().'.'.$request->featured_photo->extension();
        $request->featured_photo->move(public_path('uploads'), $final_name);

        $final_name1 = 'package_banner_'.time().'.'.$request->banner->extension();
        $request->banner->move(public_path('uploads'), $final_name1);

        $obj = new Package();
        $obj->destination_id = $request->destination_id;
        $obj->featured_photo = $final_name;
        $obj->banner = $final_name1;
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->old_price = $request->old_price;
        $obj->map = $request->map;
        $obj->total_rating = 0;
        $obj->total_score = 0;
        $obj->save();

        return redirect()->route('admin_package_index')->with('success','Paket je uspešno kreiran.');
    }

    public function edit($id)
    {
        $package = Package::where('id',$id)->first();
        $destinations = Destination::orderBy('name','asc')->get();
        return view('admin.package.edit',compact('package','destinations'));
    }
    
    public function edit_submit(Request $request, $id)
    {
        $package = Package::where('id',$id)->first();
        
        $request->validate([
            'name'        => 'required|unique:packages,name,'.$id,
            'slug'        => 'required|alpha_dash|unique:packages,slug,'.$id,
            'description' => 'required',
            'price'       => 'required|numeric',
            'old_price'   => 'numeric',
        ],[
            'name.required'        => 'Naziv paketa je obavezan.',
            'name.unique'          => 'Ovaj naziv paketa već postoji.',
            'slug.required'        => 'Slug je obavezan.',
            'slug.alpha_dash'      => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'          => 'Ovaj slug već postoji.',
            'description.required' => 'Opis je obavezan.',
            'price.required'       => 'Cena je obavezna.',
            'price.numeric'        => 'Cena mora biti broj.',
            'old_price.numeric'    => 'Stara cena mora biti broj.',
        ]);

        if($request->hasFile('featured_photo'))
        {
            $request->validate([
                'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'featured_photo.required' => 'Istaknuta fotografija je obavezna.',
                'featured_photo.image'    => 'Istaknuta fotografija mora biti slika.',
                'featured_photo.mimes'    => 'Dozvoljeni formati su: jpeg, png, jpg, gif, svg.',
                'featured_photo.max'      => 'Maksimalna veličina slike je 2MB.',
            ]);
            @unlink(public_path('uploads/'.$package->featured_photo));
            $final_name = 'package_featured_'.time().'.'.$request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $package->featured_photo = $final_name;
        }

        if($request->hasFile('banner'))
        {
            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'banner.required' => 'Baner je obavezan.',
                'banner.image'    => 'Baner mora biti slika.',
                'banner.mimes'    => 'Dozvoljeni formati banera: jpeg, png, jpg, gif, svg.',
                'banner.max'      => 'Maksimalna veličina banera je 2MB.',
            ]);
            @unlink(public_path('uploads/'.$package->banner));
            $final_name1 = 'package_banner_'.time().'.'.$request->banner->extension();
            $request->banner->move(public_path('uploads'), $final_name1);
            $package->banner = $final_name1;
        }
        
        $package->destination_id = $request->destination_id;
        $package->name = $request->name;
        $package->slug = $request->slug;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->old_price = $request->old_price;
        $package->map = $request->map;
        $package->save();

        return redirect()->route('admin_package_index')->with('success','Paket je uspešno ažuriran.');
    }

    public function delete($id)
    {
        $total = PackagePhoto::where('package_id',$id)->count();
        if($total > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve fotografije ovog paketa.');
        }

        $total1 = PackageVideo::where('package_id',$id)->count();
        if($total1 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve video snimke ovog paketa.');
        }

        $total2 = PackageAmenity::where('package_id',$id)->count();
        if($total2 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve pogodnosti (amenities) ovog paketa.');
        }

        $total3 = PackageItinerary::where('package_id',$id)->count();
        if($total3 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve itinerere ovog paketa.');
        }

        $total4 = PackageFaq::where('package_id',$id)->count();
        if($total4 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sva česta pitanja (FAQ) ovog paketa.');
        }

        $total5 = Tour::where('package_id',$id)->count();
        if($total5 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve ture povezane sa ovim paketom.');
        }

        $package = Package::where('id',$id)->first();
        @unlink(public_path('uploads/'.$package->featured_photo));
        @unlink(public_path('uploads/'.$package->banner));
        $package->delete();
        return redirect()->route('admin_package_index')->with('success','Paket je uspešno obrisan.');
    }

    public function package_amenities($id)
    {
        $package = Package::where('id',$id)->first();
        $package_amenities_include = PackageAmenity::with('amenity')->where('package_id',$id)->where('type','Include')->get();
        $package_amenities_exclude = PackageAmenity::with('amenity')->where('package_id',$id)->where('type','Exclude')->get();
        $amenities = Amenity::orderBy('name','asc')->get();
        return view('admin.package.amenities',compact('package', 'package_amenities_include', 'package_amenities_exclude', 'amenities'));
    }

    public function package_amenity_submit(Request $request, $id)
    {
        $total = PackageAmenity::where('package_id',$id)->where('amenity_id',$request->amenity_id)->count();
        if($total>0) {
            return redirect()->back()->with('error','Ova stavka je već dodata.');
        }

        $obj = new PackageAmenity;
        $obj->package_id = $id;
        $obj->amenity_id = $request->amenity_id;
        $obj->type = $request->type;
        $obj->save();

        return redirect()->back()->with('success','Stavka je uspešno dodata.');
    }

    public function package_amenity_delete($id)
    {
        $obj = PackageAmenity::where('id',$id)->first();
        $obj->delete();
        return redirect()->back()->with('success','Stavka je uspešno obrisana.');
    }

    public function package_itineraries($id)
    {
        $package = Package::where('id',$id)->first();
        $package_itineraries = PackageItinerary::where('package_id',$id)->get();
        return view('admin.package.itineraries',compact('package', 'package_itineraries'));
    }

    public function package_itinerary_submit(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required',
        ],[
            'name.required'        => 'Naziv je obavezan.',
            'description.required' => 'Opis je obavezan.',
        ]);

        $obj = new PackageItinerary;
        $obj->package_id = $id;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->save();

        return redirect()->back()->with('success','Stavka je uspešno dodata.');
    }

    public function package_itinerary_delete($id)
    {
        $obj = PackageItinerary::where('id',$id)->first();
        $obj->delete();
        return redirect()->back()->with('success','Stavka je uspešno obrisana.');
    }

    public function package_photos($id)
    {
        $package = Package::where('id',$id)->first();
        $package_photos = PackagePhoto::where('package_id',$id)->get();
        return view('admin.package.photos',compact('package', 'package_photos'));
    }

    public function package_photo_submit(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'photo.required' => 'Fotografija je obavezna.',
            'photo.image'    => 'Fotografija mora biti slika.',
            'photo.mimes'    => 'Dozvoljeni formati: jpeg, png, jpg, gif, svg.',
            'photo.max'      => 'Maksimalna veličina fotografije je 2MB.',
        ]);

        $final_name = 'package_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $obj = new PackagePhoto;
        $obj->package_id = $id;
        $obj->photo = $final_name;
        $obj->save();

        return redirect()->back()->with('success','Fotografija je uspešno dodata.');
    }

    public function package_photo_delete($id)
    {
        $package_photo = PackagePhoto::where('id',$id)->first();
        @unlink(public_path('uploads/'.$package_photo->photo));
        $package_photo->delete();
        return redirect()->back()->with('success','Fotografija je uspešno obrisana.');
    }

    public function package_videos($id)
    {
        $package = Package::where('id',$id)->first();
        $package_videos = PackageVideo::where('package_id',$id)->get();
        return view('admin.package.videos',compact('package', 'package_videos'));
    }

    public function package_video_submit(Request $request, $id)
    {
        $request->validate([
            'video' => 'required',
        ],[
            'video.required' => 'Video je obavezan (unesite YouTube embed ili URL).',
        ]);

        $obj = new PackageVideo;
        $obj->package_id = $id;
        $obj->video = $request->video;
        $obj->save();

        return redirect()->back()->with('success','Video je uspešno dodat.');
    }

    public function package_video_delete($id)
    {
        $package_video = PackageVideo::where('id',$id)->first();
        $package_video->delete();
        return redirect()->back()->with('success','Video je uspešno obrisan.');
    }

    public function package_faqs($id)
    {
        $package = Package::where('id',$id)->first();
        $package_faqs = PackageFaq::where('package_id',$id)->get();
        return view('admin.package.faqs',compact('package', 'package_faqs'));
    }

    public function package_faq_submit(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer'   => 'required',
        ],[
            'question.required' => 'Pitanje je obavezno.',
            'answer.required'   => 'Odgovor je obavezan.',
        ]);

        $obj = new PackageFaq;
        $obj->package_id = $id;
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->save();

        return redirect()->back()->with('success','FAQ je uspešno dodat.');
    }

    public function package_faq_delete($id)
    {
        $package_faq = PackageFaq::where('id',$id)->first();
        $package_faq->delete();
        return redirect()->back()->with('success','FAQ je uspešno obrisan.');
    }
}
