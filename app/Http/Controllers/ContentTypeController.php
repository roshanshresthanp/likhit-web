<?php

namespace App\Http\Controllers;

use App\Models\ContentType;
use Illuminate\Http\Request;

class ContentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentType = ContentType::paginate(10);
        return view('backend.content-type.index',compact('contentType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|regex:/^[a-zA-ZÑñ\s]+$/|max:200|unique:content_types',
        ]);

        $slug = strtolower(str_replace(' ','-',$request->title));
            try{
                ContentType::insert(['title'=>$request->title,'slug'=>$slug]);
                return redirect()->back()->with('success','Content has been added successfully');
            }
            catch(\Exception $error){
                return redirect()->back()->with(['error'=>$error->getMessage()]);
            }
    }



    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentType  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentType  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentType  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentType  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContentType::find($id)->delete();
        return redirect()->back()->with('success','Content type has been deleted');
    }
}
