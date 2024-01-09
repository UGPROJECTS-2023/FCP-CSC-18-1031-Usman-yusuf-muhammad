<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/30/2023
 * Time: 8:13 AM
 */
?>
<style>
    ul{
        margin: 0;
        padding: 0;
    }
    li{
        list-style: none;
    }
    li:hover{
        /*cursor: pointer;*/
        /*background: silver;*/
        padding: 0;
    }
    .user-wrapper, .messages-wrapper{
        border: 1px solid #dddddd;
        overflow-y: auto;
    }
    .user-wrapper{
        height: 420px;
    }
    .user{
        cursor: pointer;
        position: center;
        padding:5px 0;
    }
    .user:hover{
        background: #eeeeee;
        color: black;
    }
    .user:focus{
        background: #eeeeee;
        color: black;
    }
    .user:last-child{
        margin-bottom: 0;
    }
    .pending{
        position: absolute;
        left: 13px;
        top:9px;
        background: coral;
        color:white;
        border-radius:50% ;
        margin: 0;
        width: 18px;
        height: 18px;
        line-height: 18px;
        padding-left: 5px;
        font-size: 8px;
    }
    .media-left{
        margin: 0 10px;
    }
    .media-left img{
        width:50px;
        height: 50px;
        border-radius: 50%;
    }
    .media-body p{
        padding: 3px 0;
    }
    .messages-wrapper{
        padding: 10px;
        height: 420px;
        background: #eeeeee;

    }
    .messages .message{
        margin-bottom: 15px;
        font-size: 8px;


    }
    .messages .message:last-child{
        margin-bottom: 0;
    }
    .messages .message:first-child{
        margin-top: 50px;
    }

    .received, .sent{
        width: 80%;
        background: red;
        padding: 3px 10px;
        border-radius: 10px;
        border-width: 15px 20px 0 0;

    }
    /*.clearfix:after{*/
    /*border-style: solid;*/
    /*border-width: 0 20px 15px 0;*/
    /*border-color: transparent #fff transparent transparent;*/
    /*}*/
    @media (max-width: 920px) {
        .received, .sent{
            width: 55%;
            background: red;
            padding: 3px 10px;
            border-radius: 10px;
        }

    }
    .received{
        background: #fff;
        color: black;
    }
    .sent{
        background: rgba(173, 181, 189, 0.58);
        float: right;
        text-align: right;
    }
    .message p{
        margin: 3px 0;
    }
    .date{
        color: #777777;
        font-size: 8px;
    }
    .active{
        background: #eeeeee;
        color: black;
    }
    .email{
        margin-top: -15px;
        font-size: 10px;
        opacity: 0.5;
        overflow: hidden;
        margin-left: 5%;
    }
    input[type=text]{
        width: 100%;
        padding: 12px 20px;
        margin: 15px 0 0 0;
        display: inline-block;
        border-radius: 5px;
        box-sizing: border-box;
        outline: none;
        border: 1px solid #cccccc;
    }
    input[type=text]:focus{
        border: 1px solid #aaaaaa;
    }

</style>

@extends('templates.default')
@section('content')

    @include('templates.partials.alerts')
    <div class="row" style="padding: 80px 0;">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header" style="background: #006a00"><h4 class="text-capitalize text-white text-center">my supervisor</h4></div>
                @if(!is_null($supervisor))
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <span class="d-block text-capitalize"><b>Name: </b>{{$supervisor->firstname." ".$supervisor->lastname." ".$supervisor->middlename}} </span>
                                <span class="d-block"><b>Email: </b> {{$supervisor->email}}</span>
                                <span class="d-block"><b>Phone: </b> {{$supervisor->phone}}</span>
                                <span class="d-block text-uppercase"><b class="text-capitalize">Role: </b> {{$supervisor->officeNo}}</span>
                            </div>
                            <div class="col-6">
                                @if(!is_null($supervisor->picture))
                                    <img src="{{url('assets/uploads/profileImages/'.$supervisor->picture)}}" style="width: 100%;height: 360px">
                                @else
                                    <i class="fa fa-user fa-3x text-primary"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <span class="text-danger">You are not yet allocated to any supervisor</span>
                @endif
            </div>
        </div>
        <div class="col col-md-6">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 hideUser">
                        <div class="user-wrapper">
                            @if(!is_null($users))
                            <ul class="">
                                    <?php
                                    $lastMessage=\ProjectManagement\Models\Message::where('destination',$users->lecturer_id)->orWhere('origin',$users->lecturer_id)->latest()->first();
                                    $profile=\ProjectManagement\Models\Admin::where('id',$users->lecturer_id)->first();
                                    ?>
                                    <li class="user" id="{{$profile->id}}">
                                        @if($profile->unread)
                                            <span class="pending">{{$profile->unread}}</span>
                                        @endif
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{url('assets/uploads/profileImages/'.$profile->picture)}}" class="medial-object">
                                            </div>
                                            <div class="media-body">
                                                <p class="name">{{$profile->firstname}}</p>
                                                @if(!is_null($lastMessage))
                                                    <p class="email">{{$lastMessage->messages}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7  mt" id="messages">

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection