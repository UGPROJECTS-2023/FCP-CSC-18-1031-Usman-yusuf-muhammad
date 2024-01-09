<?php

namespace ProjectManagement\Http\Controllers\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ProjectManagement\Http\Controllers\Controller;
use ProjectManagement\Models\Admin;
use ProjectManagement\Models\Allocation;
use ProjectManagement\Models\Message;
use ProjectManagement\Models\Projects;
use ProjectManagement\Models\StudentLog;

class StudentAuth extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:web");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query=$request->input('query');
        $projects=Projects::where('title','like',"%$query%")
            ->orWhere('type','like',"%$query%")->paginate('15');
        return view('general.search')
            ->with('projects',$projects)
            ->with('title','Search | Item');
    }

    public function mySupervisor(){
        $user=auth('web')->user()->id;
        $users=Allocation::where('student_id',auth('web')->user()->id)->first();
        $getAllocations=Allocation::where('student_id',$user)->first();
//        dd($users);
//        $users=Admin::where('id',$getAllocations->lecturer_id)->where('id', '!=', Auth::id())->get();
//        $users=DB::select("select admins.id,admins.firstname,admins.picture,admins.email,count(is_read) as unread  from admins LEFT JOIN messages ON admins.id=messages.origin and is_read=0 and messages.destination=" .Auth::id()." where admins.id != " .Auth::id()." group by admins.id,admins.firstname,admins.picture,admins.email ");
        if(!is_null($getAllocations)){
            $supervisor=Admin::findOrFail($getAllocations->lecturer_id);
        }else{
            $supervisor=null;
        }
        return view('general.mySupervisor'
            ,['users'=>$users])
            ->with('title','my | supervisor')
            ->with('supervisor',$supervisor);

    }

    public function projects(Projects $projects)
    {
        return view('General.project')
            ->with('title','Project | Topics')
            ->with('projects',$projects->projects());

    }
    public function requestTopic($id){
        $projectObj=Projects::find($id);
        if($projectObj->student_id != null){
            return back()->with('failure',GeneralController::alertMaker('oops!','Someone Have Already Selected this Topic'));
        }else{
            $projectObj->student_id=auth('web')->user()->id;
            $projectObj->update();
            StudentLog::create([
                'user_id'=>auth('web')->user()->id,
                'action'=>"Selected a Project Topic",
            ]);
            return back()->with('success',GeneralController::alertMaker('successful!','You have Selected a Project Topic'));

        }
    }
    public function requestSupervisor($id){
        $projectObj=Projects::find($id);
        $supervisor=Admin::find($projectObj->lecturer_id);
        if($projectObj->student_id != null && $projectObj->student_id != auth('web')->user()->id){
            return back()->with('failure',GeneralController::alertMaker('oops!','Someone Have Already Selected this Topic'));
        }elseif (Projects::where('student_id',auth('web')->user()->id)->exists()){
            $projectObj->student_id=auth('web')->user()->id;
            $projectObj->status=1;
            $projectObj->update();
            StudentLog::create([
                'user_id'=>auth('web')->user()->id,
                'action'=>"Requested"." ".$supervisor->firstname." ".$supervisor->lastname." ".$supervisor->middlename." "."For Supervision",
            ]);
            return back()->with('success',GeneralController::alertMaker('successful!','You have Selected a Project Topic and requested for Supervision'));
        }else{
            $projectObj->student_id=auth('web')->user()->id;
            $projectObj->status=1;
            $projectObj->update();
            StudentLog::create([
                'user_id'=>auth('web')->user()->id,
                'action'=>"Requested"." ".$supervisor->firstname." ".$supervisor->lastname." ".$supervisor->middlename." "."For Supervision",
            ]);
            return back()->with('success',GeneralController::alertMaker('successful!','You have Selected a Project Topic and requested for Supervision'));
        }
    }
    public function profile()
    {
        return view('General.profile')
            ->with('title','Update | Profile');
    }
    public function createProfile(Request $request)
    {
        $this->validate($request,[
            'picture'=>'mimes:png,jpg,jpeg',
            'email'=>'required|present|email',
            'phone'=>['required','present','numeric',
                function($attribute, $value, $fail)
                {
                    if (strlen($value) < 11) {
                        $fail("The number can not be less than 11 digits");
                    } elseif (strlen($value) > 11) {
                        $fail("The number can not be greater than 11 digits");
                    }
                }
            ],
            'password'=>'confirmed',
            'password_confirmation'=>'max:50|same:password',
        ]);
        if(is_null($request->input('password'))){
            $password = auth()->guard('web')->user()->password;
        }
        else{
            $password=bcrypt($request->input('password'));
        }
        if($request->input('phone')==null){
            $phoneNumber = auth()->guard('web')->user()->phone;
        }
        else {
            $phoneNumber = $request->input('phone');
        }
        if($request->input('email')==null){
            $email = auth()->guard('web')->user()->email;
        }
        else {
            $email = $request->input('email');
        }
        if(is_null($request->file('picture'))){
            $image = auth()->guard('web')->user()->picture;
        }
        else{
            $image=GeneralController::UploadFile($request->file('picture'),[],'profileImages');
        }
        auth('web')->user()->update([
            'password'=>$password,
            'phone'=>$phoneNumber,
            'picture'=>$image,
            'email'=>$email
        ]);
        StudentLog::create([
            'user_id'=>auth('web')->user()->id,
            'action'=>"Updated Their Profile",
        ]);
        return back()->with('success',GeneralController::alertMaker('successful','Profile Have Been Updated'));
    }




    public function index()
    {
//        $users=User::where('id','!=',Auth::id())->get();
//        $users=DB::select("select users.id,users.name,users.avatar,users.email,count(is_read) as unread  from users LEFT JOIN messages ON users.id=messages.from and is_read=0 and messages.to=" .Auth::id()." where users.id != " .Auth::id()." group by users.id,users.name,users.avatar,users.email ");
        $users=Allocation::where('student_id',auth('web')->user()->id)->first();

        return view('general.chatList',['users'=>$users]);

    }
    public function getMessage($user_id){
        $my_id=auth('web')->user()->id;
        $user=Admin::where('id',$user_id)->first();
        Message::where(['origin'=>$user_id,'destination'=>$my_id])->update(['is_read'=>1]);
        $messages=Message::where(function ($query) use ($user_id, $my_id){
            $query->where('origin',$my_id)->where('destination',$user_id);
        })->orWhere(function ($query) use ($user_id,$my_id){
            $query->where('origin',$user_id)->where('destination',$my_id);
        })->get();
        return view('general.chat',['messages'=>$messages,'user'=>$user]);
    }
    public function sendMessage(Request $request){
        $from=Auth::id();
        $to=$request->receiver_id;
        $message=$request->message;
        $data=new Message();
        $data->from=$from;
        $data->to=$to;
        $data->messages=$message;
        $data->is_read=0;
        $data->save();
        $options=array(
            'cluster' => 'ap4',
            'useTLS' => true
        );
        $pusher= new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data =['from'=>$from,'to'=>$to];
        $pusher->trigger('my-channel','my-event',$data);
    }
}
