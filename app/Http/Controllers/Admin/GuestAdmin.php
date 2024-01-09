<?php

namespace ProjectManagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Validation\Rules\Password;
use ProjectManagement\Http\Controllers\Controller;
use ProjectManagement\Http\Controllers\General\GeneralController;
use ProjectManagement\Models\Admin;
use ProjectManagement\Models\LecturerLog;

class GuestAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function show(){
        return view('Admin.forms.login')
            ->with('title','Admin | Login | Page');
    }
    public function create(Request $request){
        $this->validate($request,[
            'email_address'=>'required|present|email',
            'password'=>'required|present|min:6|',
            'i'
        ]);
        if(Auth::guard('admin')->attempt([
            'email'=>$request->input('email_address'),
            'password'=>$request->input('password'),
        ])){
            if(auth('admin')->user()->privilege==1){
                LecturerLog::create([
                    'user_id'=>auth('admin')->user()->id,
                    'action'=>"Logged in",
                    'type'=>1,
                ]);

                return redirect()->route('dashboard');
            }else{
                LecturerLog::create([
                    'user_id'=>auth('admin')->user()->id,
                    'action'=>"Logged in",
                    'type'=>2
                ]);
                if(auth('admin')->user()->verify != 1){
                    auth('admin')->LogOut();
                    return redirect()->route('pending');
                }else{
                    return redirect()->route('dashboard');
                }
            }
        }else{

            return redirect()->back()->with('failure',GeneralController::alertMaker('Whoops!!!','The Details Provided Does Not Match Any Record'));
        }
    }
    public function logout()
    {
        LecturerLog::create([
            'user_id'=>auth('admin')->user()->id,
            'action'=>"Logged out",
            'type'=>3
        ]);
        if(\auth('admin')->user()->privilege===1){
            auth()->guard('admin')->LogOut();
            return redirect()->route('admin.login');
        }
        else{
            auth()->guard('admin')->LogOut();
            return redirect()->route('homepage');
        }
    }
    public function register(){
        return view('admin.forms.register',[
            'title'=>'Lecturer Register'
        ]);
    }
    public function createRegister(Request $request){
        $this->validate($request,[
            'firstname' => 'required|present|min:2|max:50',
            'lastname' => 'required|present|min:2|max:50',
            'middlename' => 'nullable|min:2|max:50',
            'staffId' => 'required|present|unique:admins,staffId',
            'email' => 'required|present|email|unique:admins,email',
            'phone' => 'required|present|unique:admins,phone',
            'picture' => 'nullable|mimes:jpg,jpeg,png',
            'officeNo'=>'required|present',
            'password'=>['required','present','confirmed'],
            'password_confirmation'=>'required|present|same:password',
        ]);
        if(is_null($request->file('picture'))){
            $image_file=null;
        }else{
            $image_file = GeneralController::UploadFile($request->file('picture'), [], "profileImages");
        }
        if(Admin::create([
            'firstname' =>$request->input('firstname'),
            'lastname'=>$request->input('lastname'),
            'middlename' =>$request->input('middlename'),
             'staffId' =>$request->input('staffId'),
             'email' =>$request->input('email'),
              'phone' => $request->input('phone'),
             'picture' =>$image_file,
             'officeNo'=>$request->input('officeNo'),
             'password'=>bcrypt($request->input('password'))
        ])){
            return redirect()->route('pending');
        }else{
            return redirect()->back()->with('failure',GeneralController::alertMaker('Whoops!!!','something went wrong'));
        }
    }
    public function pendingLecturer(){
        return view('admin.pages.pending',[
            'title'=>'Pending Account',
//            'title'=>'Pending Account',
        ]);
    }
}