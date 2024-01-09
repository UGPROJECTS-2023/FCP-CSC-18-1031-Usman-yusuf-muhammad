<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/26/2023
 * Time: 9:14 PM
 */
?>
@extends('templates.default')
@section('content')
<div class="row register-form" style="background: transparent;">
    <div class="col-md-12">
        <form class="custom-form" method="post" action="{{route('admin.register')}}" enctype="multipart/form-data" style="background: transparent;margin-top: -170px">
            <h1>Lecturer Register Form</h1> @csrf
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
                        @if($errors->has('staffId'))
                            <small class="text-danger form-text">{{$errors->first('staffId')}}</small>
                        @endif
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">StaffId </label></div>
                        <div class="col-sm-8 input-column"><input class="form-control" name="staffId" value="{{old('staffId')}}" type="text"></div>
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
                        @if($errors->has('officeNo'))
                            <small class="text-danger form-text">{{$errors->first('officeNo')}}</small>
                        @endif
                        <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Office Number </label></div>
                        <div class="col-sm-8 input-column"><input class="form-control" name="officeNo" value="{{old('officeNo')}}" type="text"></div>
                    </div>
                </div>
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
            <button class="btn btn-light submit-button" type="submit">Submit Form</button></form>
    </div>
</div>

@endsection
