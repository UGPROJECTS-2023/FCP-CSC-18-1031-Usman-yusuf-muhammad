<?php
/**
 * Created by v code.
 * User: uthman-my
 * Date: 11/17/2023
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row my-5">
        <div class="col col-md-10">
            @include('templates.partials.alerts')
            <div class="table-responsive mt-1" id="form1">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td>{{$message->name}}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->message}}</td>
                            <td>{{$message->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('messages')}}">Back to Messages</a> </li>
            </ul>
        </div>
    </div>
@endsection
