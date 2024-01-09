<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 10/29/2023
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="">
                        @foreach($users as $user)
                            <?php
                            $lastMessage=\ProjectManagement\Models\Message::where('destination',$user->student_id)->orWhere('origin',$user->student_id)->latest()->first();
                            $students=\ProjectManagement\Models\User::where('id',$user->student_id)->get();
//                            $countObj=\ProjectManagement\Models\Message::where('origin',auth()->guard('admin')->user()->id->where('destination',$user->student_id)->user()->id)->where('is_read',0)->count();
                            ?>
                                @foreach($students as $student)
                                    <li class="user" id="{{$student->id}}">
{{--                                        @if($student->unread)--}}
                                            {{--<span class="pending" style="background: red">{{$countObj}}</span>--}}
                                        {{--@endif--}}
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{url('assets/uploads/profileImages/'.$student->picture)}}" class="medial-object" style="height:60px;width:60px;border-radius: 50%">
                                            </div>
                                            <div class="media-body">
                                                <p class="name">{{$student->firstName." ".$student->lastName." ".$student->middleName}}</p>
                                                @if(!is_null($lastMessage))
                                                    <p class="email">{{$lastMessage->messages}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>

@endsection