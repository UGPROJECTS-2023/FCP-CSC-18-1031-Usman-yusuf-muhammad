<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/25/2023
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row register-form">
                <div class="col-md-12">
                    <form class="custom-form" method="post" action="{{route('admin.profile')}}" enctype="multipart/form-data">
                        @csrf
                        <?php
                        $user=auth()->guard('admin')->user();
                        ?>
                        @include('templates.partials.alerts')
                        <div class="row">
                            <div class="col-md-3 p-1 offset-md-1" style="border: 1px solid #00003e">
                                <img src="{{url('assets/uploads/profileImages/'.$user->picture)}}" style="width: inherit;max-height: 250px">
                                <input type="file" name="picture" class="form-control" style="border: none">
                            </div>
                            <div  class="col-md-8">

                                <div class="form-row form-group">
                                    <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Email Addrss</label></div>
                                    <div class="col-sm-8 input-column">
                                        @if($errors->has('email'))
                                            <small class=" text-danger">{{$errors->first('email')}}</small>
                                        @endif
                                        <input class="form-control" type="text" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Phone Number</label></div>
                                    <div class="col-sm-8 input-column">
                                        @if($errors->has('phone'))
                                            <small class=" text-danger">{{$errors->first('phone')}}</small>
                                        @endif
                                        <input class="form-control" type="text" name="phone" value="{{$user->phone}}">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Role</label></div>
                                    <div class="col-sm-8 input-column">
                                        @if($errors->has('officeNo'))
                                            <small class=" text-danger">{{$errors->first('officeNo')}}</small>
                                        @endif
                                        <input class="form-control" type="text" name="officeNo" value="{{$user->officeNo}}">
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">New Password</label></div>
                                    <div class="col-sm-8 input-column">
                                        @if($errors->has('password'))
                                            <small class=" text-danger">{{$errors->first('password')}}</small>
                                        @endif
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">ConFirm Password</label></div>
                                    <div class="col-sm-8 input-column">
                                        @if($errors->has('password_confirmation'))
                                            <small class=" text-danger">{{$errors->first('password_confirmation')}}</small>
                                        @endif
                                        <input class="form-control" type="text" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-light submit-button" type="submit">Update Profile</button>
                    </form>
                </div>
    </div>
@endsection
