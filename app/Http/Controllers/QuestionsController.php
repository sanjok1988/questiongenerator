<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Question;
use App\Subject;
use App\Http\Requests\StoreQuestionRequest; 
use App\Http\Requests\UpdateQuestionRequest; 
use Session;

class QuestionsController extends Controller
{
    protected $question, $subject;

    public function __construct(Question $question, Subject $subject){

        $this->question = $question;
        $this->subject = $subject;
    }
    public function index(){
        $questions = $this->question
        ->leftJoin('subjects as s', 's.id', 'questions.subject_id')
        ->orderby('questions.id','DESC')->paginate(10);
        return view("questions.index")->with(compact('questions'));
    }

    public function add(){
        $subjects = $this->subject->get();
        return view("questions.add")->with(compact("subjects"));
    }

    public function store(StoreQuestionRequest $request){
    
        $response = $this->question->create($request->only(['subject_id','text','diff_level','mark']));

        if ($response->exists) {
            $notification = array(
                'message' => 'Data Successfully Stored!', 
                'alert-class' => 'alert-success'
            ); 
         
            return Redirect::to('questions/add')->with($notification);
            
        }else{
            $notification = array(
                'message' => "error", 
                'alert-class' => 'alert-danger'
            );

            return Redirect::to('questions/add')->with($notification);
        }
    }

    public function edit($id){
        $question = $this->question->findOrFail($id);
        $subjects = $this->subject->get();
        return view("questions.edit")->with(compact("question","subjects"));
    }

    public function update(StoreQuestionRequest $request){
        $data = $this->question->find($request->id);
        if($data->update($request->only(['subject_id','text','diff_level','mark']))){
            $notification = array(
                'message' => 'Data Successfully Updated!', 
                'alert-class' => 'alert-success'
            );            
         
            return Redirect::to('questions')->with($notification);
        }else{
            $notification = array(
                'message' => 'Update Process Failed!', 
                'alert-class' => 'alert-danger'
            );            
         
            return Redirect::to('questions')->with($notification);
        }
        
    }

    public function delete($id){
        $data = $this->question->find($id);
        if($data->delete()){
            $notification = array(
                'message' => 'Data Successfully Deleted!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('questions')->with($notification);
        }
        
    }
}