<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/29/2023
 * Time: 8:18 AM
 */
?>

<div class="messages-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            {{--{{dd($message)}}--}}
            <li class="clearfix message">
                <div class="{{ ($message->origin == auth()->guard('admin')->user()->id) ? 'sent' : 'received'}}">
                    <p>{{$message->messages}}</p>
                    <p class="date">{{date('d M y, h:i a',strtotime($message->created_at))}}</p>
                </div>
            </li>

        @endforeach
    </ul>
</div>
<div class="input-text">
    <div class="header mb-2" style="position: absolute;padding: 10px;background: #00003e;width: 95%;top: 0">

        <button class="btn btn-sm d-block d-md-none" id="backButton" type="button"><i class="fa fa-arrow-circle-left"></i> </button>
        <p class="text-capitalize d-block text-white mt-md-0" style="text-align: center;margin-top: -28px">
            {{$user->firstName." ".$user->lastName." ".$user->middleName}}
        </p>
    </div>
    <input type="text" name="message" class="submit">
</div>
