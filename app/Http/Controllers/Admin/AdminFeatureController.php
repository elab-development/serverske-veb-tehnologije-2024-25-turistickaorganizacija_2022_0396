<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
    public function index()
    {
        $features = Feature::get();
        return view('admin.feature.index', compact('features'));
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'icon'        => 'required',
            'heading'     => 'required',
            'description' => 'required',
        ],[
            'icon.required'        => 'Ikonica je obavezna.',
            'heading.required'     => 'Naslov je obavezan.',
            'description.required' => 'Opis je obavezan.',
        ]);

        $obj = new Feature();
        $obj->icon        = $request->icon;
        $obj->heading     = $request->heading;
        $obj->description = $request->description;
        $obj->save();

        return redirect()->route('admin_feature_index')->with('success','Funkcionalnost je uspešno kreirana.');
    }

    public function edit($id)
    {
        $feature = Feature::where('id',$id)->first();
        return view('admin.feature.edit', compact('feature'));
    }
    
    public function edit_submit(Request $request, $id)
    {
        $obj = Feature::where('id',$id)->first();
        
        $request->validate([
            'icon'        => 'required',
            'heading'     => 'required',
            'description' => 'required',
        ],[
            'icon.required'        => 'Ikonica je obavezna.',
            'heading.required'     => 'Naslov je obavezan.',
            'description.required' => 'Opis je obavezan.',
        ]);

        $obj->icon        = $request->icon;
        $obj->heading     = $request->heading;
        $obj->description = $request->description;
        $obj->save();

        return redirect()->route('admin_feature_index')->with('success','Funkcionalnost je uspešno izmenjena.');
    }

    public function delete($id)
    {
        $feature = Feature::where('id',$id)->first();
        $feature->delete();
        return redirect()->route('admin_feature_index')->with('success','Funkcionalnost je uspešno obrisana.');
    }
}
