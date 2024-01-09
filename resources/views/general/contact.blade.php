<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/23/2023
 * Time: 7:47 AM
 */
?>
@extends('templates.default')
@section('content')
    @include('templates.partials.alerts')

    <div class="contact-clean">
        <form method="post" action="{{route('contact')}}" id="form1">
            @csrf    <h3 class="text-center text-uppercase">Contact us</h3>

            <div class="form-group">
                @if($errors->has('name'))
                    <small class="text-danger form-text">{{$errors->first('name')}}</small>
                @endif
                <input class="form-control" type="text" value="{{old('name')}}" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                @if($errors->has('email'))
                    <small class="text-danger form-text">{{$errors->first('email')}}</small>
                @endif
                <input class="form-control " type="text" name="email" value="{{old('email')}}" placeholder="Email">
            </div>
            <div class="form-group">
                @if($errors->has('message'))
                    <small class="text-danger form-text">{{$errors->first('message')}}</small>
                @endif
                <textarea class="form-control" rows="14" name="message" placeholder="Message">{{old('message')}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-block text-white" type="submit" style="background: #043d04">send </button>
            </div>
        </form>
    </div>
@endsection

