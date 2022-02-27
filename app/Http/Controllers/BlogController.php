<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.blogs.index',compact('blogs'));
    }
    public function create(Request $request)
    {
        return view('backend.blogs.create');
    }
    public function edit($id)
    {
        $blogs = Blog::latest()->get();
        return view('backend.blogs.create',compact('blogs'));
    }
    public function store(Request $request)
    {
        $this->validate($request,
        [
           'name'=>'nullable' 
        ]);
        $input = $request->all();

        Blog::create($input);
        return redirect(route('blog.index'))->with('success','Blogs has been added');
    }
    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->back()->with('success','Blog has been deleted');
    }
}
