<?php

namespace ProjectManagement\Http\Controllers\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ProjectManagement\Http\Controllers\Controller;
use ProjectManagement\Models\Admin;
use ProjectManagement\Models\Allocation;
use ProjectManagement\Models\Message;
use ProjectManagement\Models\User;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::user());
    }
    public function index()
    {

        $users=Allocation::where('lecturer_id',auth('admin')->user()->id)->get();
//        $messageObj=Message::where('origin',auth('admin')->user()->id)->where('is_read',0);

//        $users=DB::select("select users.id,users.name,users.avatar,users.email,count(is_read) as unread  from users LEFT JOIN messages ON users.id=messages.from and is_read=0 and messages.to=" .Auth::id()." where users.id != " .Auth::id()." group by users.id,users.name,users.avatar,users.email ");
            return view('admin.pages.liveChat',[
                'users'=>$users,'title'=>'Chat','heading'=>'Live Chat with Students'
            ]);



    }
    public function getMessage($user_id){
        $my_id=auth('admin')->user()->id;
        $user=User::where('id',$user_id)->first();
        Message::where(['origin'=>$user_id,'destination'=>$my_id])->update(['is_read'=>1]);
        $messages=Message::where(function ($query) use ($user_id, $my_id){
            $query->where('origin',$my_id)->where('destination',$user_id);
        })->orWhere(function ($query) use ($user_id,$my_id){
            $query->where('origin',$user_id)->where('destination',$my_id);
        })->get();
        return view('admin.pages.chat',['messages'=>$messages,'user'=>$user]);
    }
    public function sendMessage(Request $request){
        $from=auth('admin')->user()->id;
        $to=$request->receiver_id;
        $message=$request->message;
        $data=new Message();
        $data->origin=$from;
        $data->destination=$to;
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




    public function userGetMessage($user_id){
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
    public function userSendMessage(Request $request){
        $from=auth('web')->user()->id;
        $to=$request->receiver_id;
        $message=$request->message;
        $data=new Message();
        $data->origin=$from;
        $data->destination=$to;
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
