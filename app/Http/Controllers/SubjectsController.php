<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Subject;
use App\Http\Requests\StoreSubjectRequest; 
use App\Http\Requests\UpdateSubjectRequest; 
use Session;

class SubjectsController extends Controller
{
    protected $subject;

    public function __construct(Subject $subject){

        $this->subject = $subject;
    }
    public function index() {
        $subjects = $this->subject->orderby('id','DESC')->paginate(10);
        return view("subjects.index")->with(compact('subjects'));
    }

    public function add(){
        
        return view("subjects.add");
    }

    public function store(StoreSubjectRequest $request){
    
        $response = $this->subject->create($request->only(['name','code']));
        
        if($response->exists){
            $notification = array(
                'message' => 'Data Successfully Stored!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('subjects/add')->with($notification);
            
        }else{
            $notification = array(
                'message' => $errors->all(), 
                'alert-class' => 'alert-danger'
            );

            return Redirect::to('subjects/add')->withErrors($notification);
        }
    }

    public function edit($id){
        $subjects = $this->subject->findOrFail($id);
        return view("subjects.edit")->with(compact("subjects"));
    }

    public function update(UpdateSubjectRequest $request){
        $data = $this->subject->find($request->id);
        if($data->update($request->only(['name']))){
            $notification = array(
                'message' => 'Data Successfully Updated!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('subjects')->with($notification);
        }else{
            $notification = array(
                'message' => 'Update Process Failed!', 
                'alert-class' => 'alert-danger'
            );
            
         
            return Redirect::to('subjects')->with($notification);
        }
        
    }

    public function delete($id){
        $data = $this->subject->find($id);
        if($data->delete()){
            $notification = array(
                'message' => 'Data Successfully Deleted!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('subjects')->with($notification);
        }
        
    }
}
