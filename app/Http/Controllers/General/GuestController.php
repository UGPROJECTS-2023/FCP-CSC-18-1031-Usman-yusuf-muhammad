<?php

namespace ProjectManagement\Http\Controllers\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectManagement\Http\Controllers\Controller;
use ProjectManagement\Models\StudentLog;
use ProjectManagement\Models\User;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        return view('general.login')
            ->with('title','Login | Page');
    }

    public function createLogin(Request $request)
    {
        $this->validate($request,[
            'email_address'=>'required|present|email',
            'password'=>'required|present|min:6'
        ]);
        if(Auth::guard('web')->attempt([
            'email'=>$request->input('email_address'),
            'password'=>$request->input('password')
        ])){
            if(auth('web')->user()->verify !=1){
                auth('web')->LogOut();
                return redirect()->route('pending');

            }else{
                StudentLog::create([
                    'user_id'=>auth('web')->user()->id,
                    'action'=>"logged in",
                ]);
                return redirect()->route('homepage');

            }
        }else{
            return back()->with('failure',GeneralController::alertMaker('Whoops!','Invalid Login Details'));
        }
    }

    public function showRegister(){
        return view('general.register',[
            'title'=>'Students | Register'
        ]);
    }
    public function createRegister(Request $request){
        $this->validate($request,[
            'firstname' => 'required|present|min:2|max:50',
            'lastname' => 'required|present|min:2|max:50',
            'middlename' => 'nullable|min:2|max:50',
            'regNo' => 'required|present|unique:users,regNo',
            'email' => 'required|present|email|unique:users,email',
            'phone' => 'required|present|unique:users,phone',
            'picture' => 'nullable|mimes:jpg,jpeg,png',
            'password'=>['required','present','confirmed'],
            'password_confirmation'=>'required|present|same:password',
        ]);
        if(is_null($request->file('picture'))){
            $image_file=null;
        }else{
            $image_file = GeneralController::UploadFile($request->file('picture'), [], "profileImages");
        }
        if(User::create([
            'firstName' =>$request->input('firstname'),
            'lastName'=>$request->input('lastname'),
            'middleName' =>$request->input('middlename'),
            'regNo' =>$request->input('regNo'),
            'email' =>$request->input('email'),
            'phone' => $request->input('phone'),
            'picture' =>$image_file,
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
        ]);
    }

    public function logout()
    {
        StudentLog::create([
            'user_id'=>auth('web')->user()->id,
            'action'=>"logged out",
        ]);
        auth('web')->LogOut();
        return redirect()->route('homepage');
    }

}
