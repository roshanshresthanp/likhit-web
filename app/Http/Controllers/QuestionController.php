<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->get();
        return view('backend.questions.index',compact('questions'));
    }
    public function create(Request $request)
    {
        $exams = Exam::all();
        $subjects = Subject::all();
        return view('backend.questions.form',compact('exams','subjects'));
    }
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('backend.questions.form',compact('question'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,
        [
           'question'=>'required|max:255',
           'posted_by'=>'nullable|max:255',
           'description'=>'nullable|max:2000',
           'publish_status'=>'nullable',
           'answer'=>'required',
           'right_answer'=>'required'
        ]);
        try{
            $input = $request->all();
             $input['status'] = $request->publish_status ?? 0;
            if($request->hasFile('image')){
                $input['image'] = $request->file('image')->store('questions','uploads');
            }
            $answer = $request->answer;
            
            // dd($answer);
            $right_answer = $request->right_answer;
            array_push($answer,$right_answer);
            // dd($answer);
            // dd($answer);

            $input['slug'] = str_slug($request->title);
            $question = Question::create($input);
            
            for($i=0; $i<count($answer); $i++)
            {
                Answer::create([
                    'question_id'=>$question->id,
                    'answer'=>$answer[$i]
                ]);
            }

            // Answer::create()
        return redirect(route('questions.index'))->with('success','Blogs has been added');
        }catch(\Exception $error){
        return redirect()->back()->with('error',$error->getMessage());
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
                $input['image'] = $request->file('image')->store('questions','uploads');
            }
            $input['slug'] = str_slug($request->title);
            Question::findOrFail($id)->update($input);
        return redirect(route('question.index'))->with('success','Blogs has been added');
        }catch(\Exception $error){
        return redirect()->back()->with(['danger'=>$error->getMessage()]);
        }
    }
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->back()->with('success','Question has been deleted');
    }
}
