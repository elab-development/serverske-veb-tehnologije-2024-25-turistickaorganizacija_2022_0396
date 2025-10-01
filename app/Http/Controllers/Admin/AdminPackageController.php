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
            'name.required'        => 'Naziv paketa je obavezan.',
            'name.unique'          => 'Ovaj naziv paketa već postoji.',
            'slug.required'        => 'Slug je obavezan.',
            'slug.alpha_dash'      => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique'          => 'Ovaj slug već postoji.',
            'description.required' => 'Opis je obavezan.',
            'price.required'       => 'Cena je obavezna.',
            'price.numeric'        => 'Cena mora biti broj.',
            'old_price.numeric'    => 'Stara cena mora biti broj.',
            'featured_photo.required' => 'Fotografija je obavezna.',
            'featured_photo.image'    => 'Fotografija mora biti slika.',
            'banner.required'      => 'Baner je obavezan.',
            'banner.image'         => 'Baner mora biti slika.'
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
            'slug.required'        => 'Slug je obavezan.',
            'description.required' => 'Opis je obavezan.',
            'price.required'       => 'Cena je obavezna.'
        ]);

        if($request->hasFile('featured_photo'))
        {
            $request->validate([
                'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            unlink(public_path('uploads/'.$package->featured_photo));
            $final_name = 'package_featured_'.time().'.'.$request->featured_photo->extension();
            $request->featured_photo->move(public_path('uploads'), $final_name);
            $package->featured_photo = $final_name;
        }

        if($request->hasFile('banner'))
        {
            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            unlink(public_path('uploads/'.$package->banner));
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
            return redirect()->back()->with('error','Prvo obrišite sve pogodnosti ovog paketa.');
        }

        $total3 = PackageItinerary::where('package_id',$id)->count();
        if($total3 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve itinerere ovog paketa.');
        }

        $total4 = PackageFaq::where('package_id',$id)->count();
        if($total4 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve FAQ ovog paketa.');
        }

        $total5 = Tour::where('package_id',$id)->count();
        if($total5 > 0) {
            return redirect()->back()->with('error','Prvo obrišite sve ture ovog paketa.');
        }

        $package = Package::where('id',$id)->first();
        unlink(public_path('uploads/'.$package->featured_photo));
        unlink(public_path('uploads/'.$package->banner));
        $package->delete();
        return redirect()->route('admin_package_index')->with('success','Paket je uspešno obrisan.');
    }
}
