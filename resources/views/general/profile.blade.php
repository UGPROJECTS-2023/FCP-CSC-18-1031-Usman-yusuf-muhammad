<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/27/2023
 * Time: 8:35 AM
 */
?>
@extends('templates.default')
@section('content')
    <div class="row register-form">
        <div class="col-md-12">

            <form class="custom-form" method="post" action="{{route('user.profile')}}" enctype="multipart/form-data" style="background: none;">
                @csrf                <h3 class="text-capitalize text-white mb-4">Profile Update</h3>

            <?php
                $user=auth()->guard('web')->user();
                ?>
                @include('templates.partials.alerts')
                <div class="row">
                    <div class="col-md-3 p-1 offset-md-1" style="border: 1px solid #f1f1f1">
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
                <button class="btn btn-light submit-button" type="submit" style="background: #006a00">Update Profile</button>
            </form>
        </div>
    </div>


@endsection