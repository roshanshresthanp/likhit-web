<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamSubject;
use Illuminate\Http\Request;

class ExamSubjectController extends Controller
{
    public function index(Request $request)
    {
        // $subjects = ExamSubject::latest()->get();
        // return view('backend.subjects.index',compact('subjects'));

        $car = Exam::find(1)->questions;
        $bike = Exam::find(2)->questions;
        return $bike;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subjects.form');
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
            'title'=>'required|max:225',
            'featured_img'=>'nullable|mimes:png,jpg,svg,web,jpeg'
        ]);
        $data = $request->all();
        if($request->hasFile('featured_img')){
            $data['featured_img'] = $request->file('featured_img')->store('subjects','uploads');
        }
        $data['slug'] = Str::slug($request->title);
        try{
            ExamSubject::create($data);
            return redirect()->route('subjects.index')->with('success','ExamSubject has been added successfully');
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e]);
        }
      
        // return redirect()->back()->with('success','Success Yess');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = ExamSubject::find($id);
        return view('backend.subjects.form',compact('subject'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|max:225',
            'featured_img'=>'nullable'
        ]);
        $data = $request->all();
        if($request->hasFile('featured_img')){
            $data['featured_img'] = $request->file('featured_img')->store('subjects','uploads');
        }
        $data['slug'] = Str::slug($request->title);
        try{
            ExamSubject::findOrFail($id)->update($data);
            return redirect()->route('subjects.index')->with('success','ExamSubject has been updated successfully');
        }catch(\Exception $e){
            // Session::flash('message', 'This is a message!');
            return redirect()->back()->with(['error'=>$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExamSubject::findOrFail($id)->delete();
        return redirect()->back()->with('success','ExamSubject has been deleted successfully');
    }
}
