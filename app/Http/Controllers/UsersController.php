<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Role;
use Session;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Encryption\DecryptException;

class UsersController extends Controller
{
    protected $user;

    public function __construct(User $user){

        $this->middleware('auth');
        $this->user = $user;
    }
    public function index(Request $request) {
     
        $request->user()->authorizeRoles('admin');
        $users = $this->user->orderby('id','DESC')->paginate(10);
        return view("users.index")->with(compact('users'));
    }

    public function add(){
        
        return view("users.add");
    }

    public function edit($id){
        $user = $this->user->findOrFail($id);
        try{
            $user['oldPassword'] = decrypt($user->password);
        }catch(DecryptException $e){

        }
        
        return view("users.edit")->with(compact("user"));
    }

    public function assignRole($id){

        $user = $this->user->find($id)->roles;
        
        $roles = Role::all();           
        return view("users.assign_role")->with(compact(["user","id","roles"]));
    }

    public function updateRole(Request $request){
        $user = $this->user->find($request->id);
        $detach = $user->roles()->detach();
       //The attach method doesn't return any thing, 
       //this is why you are getting null. 
       //To check if record was inserted successfully you would need to make another call to DB
        $dd = $user->roles()->attach(Role::where('name', $request->name)->first());
             
  
        $notification = array(
            'message' => 'Role Successfully Updated!', 
            'alert-class' => 'alert-success'
        );

        return redirect::to("users")->with($notification);
    }

    public function store(StoreuserRequest $request){
    
        $response = $this->user->create($request->only(['name','code']));
        
        if($response->exists){
            $notification = array(
                'message' => 'Data Successfully Stored!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('users/add')->with($notification);
            
        }else{
            $notification = array(
                'message' => $errors->all(), 
                'alert-class' => 'alert-danger'
            );

            return Redirect::to('users/add')->withErrors($notification);
        }
    }



    public function update(UpdateUserRequest $request){
        $password = $request->password;
        $confirmPassword = $request->confirmPassword;
       if($password != $confirmPassword){
            $notification = array(
                'message' => 'Confirm Password and password mismatch!', 
                'alert-class' => 'alert-warning'
            );
            return back()->with($notification);
       }
        $usr = $this->user->find($request->id);
        if($usr->update(['password'=>$password])){
            $notification = array(
                'message' => 'Data Successfully Updated!', 
                'alert-class' => 'alert-success'
            );            
         
            return Redirect::to('users')->with($notification);
        }else{
            $notification = array(
                'message' => 'Update Process Failed!', 
                'alert-class' => 'alert-danger'
            );
            
         
            return Redirect::to('users')->with($notification);
        }
        
    }

    public function delete($id){
        $data = $this->user->find($id);
        if($data->delete()){
            $notification = array(
                'message' => 'Data Successfully Deleted!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('users')->with($notification);
        }
        
    }
}
