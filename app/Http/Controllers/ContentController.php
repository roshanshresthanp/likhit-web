<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentType;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentType = ContentType::all();
        return view('backend.contents.index',compact('contentType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contentType = ContentType::all();
        return view('backend.contents.create',compact('contentType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'menu_title'=>'required|string',
            'type_id'=>'required|integer',
            'content_page_title'=>'string|max:250',
            'show_on'=>'nullable',
            'description'=>'nullable',
            'summary'=>'nullable',
            ''
        ]);
        $input = $request->all();
        
        
        try{
            if($request->hasFile('parallex_img')){
                $input['parallex_img'] = $request->file('parallex_img')->store('uploads');
            }
            if($request->hasFile('featured_img')){
                $input['featured_img'] = $request->file('featured_img')->store('uploads');
            }
            $input['show_on'] = json_encode($request->show_on);
            Content::create($input);
            return redirect(route('content.index'))->with('success','Content has been added');

        }catch(\Exception $error){
        return redirect()->back()->with('error',$error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $contentType = ContentType::all();
        return view('backend.contents.create',compact('content','contentType'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Content::findOrFail($id)->delete();
        return redirect()->with('success','Content has been deleted');
    }
}
