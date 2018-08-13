<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Exam;
use App\Subject;
use App\ExamType;
use App\Http\Requests\StoreexamRequest;
use App\Http\Requests\UpdateexamRequest; 
use Session;

class ExamsController extends Controller
{
    protected $exam, $subject, $exam_type;

    public function __construct(Exam $exam, Subject $subject, ExamType $exam_type){

        $this->middleware('auth');
        $this->exam = $exam;
        $this->subject = $subject;
        $this->exam_type = $exam_type;
    }
    public function index(Request $request){
        $request->user()->authorizeRoles('admin');
        $exams = $this->exam
        ->leftJoin('exams_types as t', 't.id', '=', 'exams.exam_type_id')
        ->orderby('exams.id','DESC')->paginate(10);
        return view("exams.index")->with(compact('exams'));
    }

    public function add(Request $request){
        $request->user()->authorizeRoles('admin');
        try{
            $subjects = $this->subject->get();
            $exam_types = $this->exam_type->get();
        }catch(Exception $e){
            print($e);
        }
       
        return view("exams.add")->with(compact('subjects','exam_types'));
    }

    public function store(Request $request){
    
        $response = $this->exam->create($request->only(['exam_type_id','fm','pm','subject_id','semester','duration','date']));
        
        if($response->exists){
            $notification = array(
                'message' => 'Data Successfully Stored!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('exams/add')->with($notification);
            
        }else{
            $notification = array(
                'message' => "error", 
                'alert-class' => 'alert-danger'
            );

            return Redirect::to('exams/add')->withErrors($notification);
        }
    }

    public function edit($id){
        try{
            $subjects = $this->subject->get();
            $exam_types = $this->exam_type->get();
            $exams = $this->exam->findOrFail($id);
        }catch(Exception $e){
            print($e);
        }
        
        return view("exams.edit")->with(compact("exams","subjects","exam_types"));
    }

    public function update(Request $request){
        $data = $this->exam->find($request->id);
        if($data->update($request->only(['exam_type_id','fm','pm','subject_id','semester','duration','date']))){
            $notification = array(
                'message' => 'Data Successfully Updated!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('exams')->with($notification);
        }else{
            $notification = array(
                'message' => 'Update Process Failed!', 
                'alert-class' => 'alert-danger'
            );
            
         
            return Redirect::to('exams')->with($notification);
        }
        
    }

    public function delete(Request $request, $id){
        $request->user()->authorizeRoles(['admin']);
        $data = $this->exam->find($id);
        if($data->delete()){
            $notification = array(
                'message' => 'Data Successfully Deleted!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('exams')->with($notification);
        }
        
    }
}
