<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/29/2023
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
        background: silver;
        padding: 0;
        color: black;
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
        text-color: black;
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


<div class="messages-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="clearfix message pt-4">
                <div class="{{ ($message->origin == auth()->guard('web')->user()->id) ? 'sent' : 'received'}}">
                    <p style="margin: 0;font-size: 12px;color:black">{{$message->messages}}</p>
                    <p class="date" style="font-size: 10px;margin: 0;color: red">{{date('d M y, h:i a',strtotime($message->created_at))}}</p>
                </div>
            </li>

        @endforeach
    </ul>
</div>
<div class="input-text">
    <div class="header mb-2" style="position: absolute;padding: 10px;background: #00003e;width: 95%;top: 0">

        <button class="btn btn-sm d-block d-md-none" id="backButton" type="button"><i class="fa fa-arrow-circle-left"></i> </button>
        <p class="text-capitalize d-block text-white mt-md-0" style="text-align: center;margin-top: -28px">
            {{$user->firstname." ".$user->lastname." ".$user->middlename}}
        </p>
    </div>
    <input type="text" name="message" class="submit">
</div>
