<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Post;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {
        $blog_categories = BlogCategory::get();
        return view('admin.blog_category.index', compact('blog_categories'));
    }

    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:blog_categories',
        ],[
            'name.required' => 'Naziv kategorije je obavezan.',
            'slug.required' => 'Slug je obavezan.',
            'slug.alpha_dash' => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique' => 'Ovaj slug već postoji.',
        ]);

        $obj = new BlogCategory();
        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->save();

        return redirect()->route('admin_blog_category_index')->with('success','Kategorija bloga je uspešno kreirana.');
    }

    public function edit($id)
    {
        $blog_category = BlogCategory::where('id', $id)->first();
        return view('admin.blog_category.edit', compact('blog_category'));
    }
    
    public function edit_submit(Request $request, $id)
    {
        $obj = BlogCategory::where('id', $id)->first();
        
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:blog_categories,slug,'.$id,
        ],[
            'name.required' => 'Naziv kategorije je obavezan.',
            'slug.required' => 'Slug je obavezan.',
            'slug.alpha_dash' => 'Slug može sadržati samo slova, brojeve, crtice i donje crte.',
            'slug.unique' => 'Ovaj slug već postoji.',
        ]);

        $obj->name = $request->name;
        $obj->slug = $request->slug;
        $obj->save();

        return redirect()->route('admin_blog_category_index')->with('success','Kategorija bloga je uspešno izmenjena.');
    }

    public function delete($id)
    {
        $total = Post::where('blog_category_id', $id)->count();
        if($total > 0)
        {
            return redirect()->back()->with('error','Ova kategorija se koristi u postovima, pa ne može biti obrisana.');
        }

        $category = BlogCategory::where('id', $id)->first();
        $category->delete();
        return redirect()->route('admin_blog_category_index')->with('success','Kategorija bloga je uspešno obrisana.');
    }
}
