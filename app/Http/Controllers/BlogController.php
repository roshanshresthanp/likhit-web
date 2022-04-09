<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $blog = Blog::findOrFail($id);
        return view('backend.blogs.create',compact('blog'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,
        [
           'title'=>'required|max:255',
           'posted_by'=>'nullable|max:255',
           'description'=>'nullable|max:2000',
           'publish_status'=>'nullable'
        ]);
        try{
            $input = $request->all();
             $input['status'] = $request->publish_status ?? 0;
            if($request->hasFile('image')){
                $input['image'] = $request->file('image')->store('blogs','uploads');
            }
            $input['slug'] = Str::slug($request->title);
            Blog::create($input);
        return redirect(route('blog.index'))->with('success','Blogs has been added');
        }catch(\Exception $error){
        return redirect()->back()->with(['danger'=>$error]);
        }
    }
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $this->validate($request,
        [
           'title'=>'required|max:255',
           'posted_by'=>'nullable|max:255',
           'description'=>'nullable|max:2000',
           'publish_status'=>'nullable'
        ]);
        try{
            $input = $request->all();
            $input['status'] = $request->publish_status ?? 0;
            if($request->hasFile('image')){
                $input['image'] = $request->file('image')->store('blogs','uploads');
            }
            $input['slug'] = Str::slug($request->title);
            Blog::findOrFail($id)->update($input);
        return redirect(route('blog.index'))->with('success','Blogs has been added');
        }catch(\Exception $error){
        return redirect()->back()->with(['danger'=>$error]);
        }
    }
    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->back()->with('success','Blog has been deleted');
    }
}
