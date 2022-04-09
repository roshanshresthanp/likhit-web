<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ExamController extends Controller
{
    public function index(Request $request)
    {
        $exams = Exam::latest()->get();
        return view('backend.exams.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.exams.form');
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
            'featured_img'=>'nullable'
        ]);
        $data = $request->all();
        if($request->hasFile('featured_img')){
            $data['featured_img'] = $request->file('featured_img')->store('exams','uploads');
        }
        $data['slug'] = Str::slug($request->title);
        try{
            Exam::create($data);
            return redirect()->route('exams.index')->with('success','Exam type has been added successfully');
        }catch(\Exception $e){
            // Session::flash('message', 'This is a message!');
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
        $exam = Exam::find($id);
        return view('backend.exams.form',compact('exam'));

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
            $data['featured_img'] = $request->file('featured_img')->store('exams','uploads');
        }
        $data['slug'] = Str::slug($request->title);
        try{
            Exam::findOrFail($id)->update($data);
            return redirect()->route('exams.index')->with('success','Exam type has been updated successfully');
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
        Exam::findOrFail($id)->delete();
        return redirect()->back()->with('success','Exam has been deleted');
    }

    public function examSubject($id)
    {
        $exam = Exam::findOrFail($id);
        $subjects = Subject::all();
        // dd($exam);
        return view('backend.subjects.index',compact('exam'));
    }
}
