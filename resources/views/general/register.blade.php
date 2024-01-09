<?php
/**
 * Created by Vs code.
 * User: uthman-my
 * Date: 10/27/2023
 * Time: 8:10 AM
 */
?>
@extends('templates.default')
@section('content')
    @include('templates.partials.alerts')

    <div class="row register-form" style="background: transparent;">
        <div class="col-md-12">
            <form class="custom-form" method="post" action="{{route('user.register')}}" enctype="multipart/form-data" style="background: transparent;">
                <h3 class="text-capitalize text-white mb-4">Student Register</h3> @csrf
                @include('templates.partials.alerts')
                <div class="row">
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('firstname'))
                                <small class="text-danger form-text">{{$errors->first('firstname')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Firstname </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="firstname" value="{{old('firstname')}}" type="text"></div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('lastname'))
                                <small class="text-danger form-text">{{$errors->first('lastname')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Lastname </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="lastname" value="{{old('lastname')}}" type="text"></div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('middlename'))
                                <small class="text-danger form-text">{{$errors->first('middlename')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Middlename </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="middlename" value="{{old('middlename')}}" type="text"></div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('regNo'))
                                <small class="text-danger form-text">{{$errors->first('regNo')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">RegNo </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="regNo" value="{{old('regNo')}}" type="text"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('email'))
                                <small class="text-danger form-text">{{$errors->first('email')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Email Address </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="email" value="{{old('email')}}" type="text"></div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('phone'))
                                <small class="text-danger form-text">{{$errors->first('phone')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Phone Number </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="phone" value="{{old('phone')}}" type="text"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('picture'))
                                <small class="text-danger form-text">{{$errors->first('picture')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Avatar </label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="picture" type="file"></div>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('password'))
                                <small class="text-danger form-text">{{$errors->first('password')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Password</label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="password"  type="password"></div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-row form-group">
                            @if($errors->has('password_confirmation'))
                                <small class="text-danger form-text">{{$errors->first('password_confirmation')}}</small>
                            @endif
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Confirm Password</label></div>
                            <div class="col-sm-8 input-column"><input class="form-control" name="password_confirmation" type="password"></div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-light submit-button" type="submit" style="background: #006a00">Submit Form</button></form>
        </div>
    </div>

@endsection
