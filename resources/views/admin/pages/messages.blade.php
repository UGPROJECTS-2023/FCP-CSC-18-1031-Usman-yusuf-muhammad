<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/17/2023
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
                    @if($messages->count()>0)
                    @foreach($messages as $message)
                    <tr>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->message}}</td>
                        <td>{{$message->created_at}}</td>
                        <td><a href="{{route('attended',['attended'=>$message->id])}}" class="btn btn-sm btn-success">Mark as Read</a> </td>
                    </tr>
                    @endforeach
                    @else
                        <tr><td colspan="5"><p class="text-danger text-center">No Recent Message</p> </td> </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('allMessages')}}">All Messages</a> </li>
            </ul>
        </div>
    </div>
@endsection
