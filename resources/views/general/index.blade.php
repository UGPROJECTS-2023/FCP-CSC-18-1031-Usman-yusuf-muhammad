<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/23/2023
 */
?>
@extends('templates.default')
@section('content')
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6 offset-xl-1">
                <div class="row">
                    <div class="col-md-12" style="margin-top:10px;">
                        {{--<h5 class="text-center welcome animated bounceInDown" style="color:rgb(255,255,255);font-family:'Advent Pro', sans-serif;">Welcome To</h5>--}}
                        <h2 class="text-center tamil animated bounceInUp" style="color:#a5b7c6;font-family:Arial Rounded MT Bold;margin-top:21px;">PROJECT MANAGEMENT<br> SYSTEM</h2>
                        <div class="row">
                            <div class="col-md-12 col-xl-12 offset-xl-0" style="color:rgb(255,255,255);font-family:'Advent Pro', sans-serif;">
                                <div class="row">
                                    <div class="col-md-12 col-xl-12 offset-xl-0" style="color:rgb(255,255,255);font-family:'Advent Pro', sans-serif;">
                                        <div id="wowslider-container1">
                                            <div class="ws_images">
                                                <ul>
                                                    @if(!is_null($slides))
                                                        <?php $counter=0; ?>
                                                        @foreach($slides as $slide)
                                                            <li>
                                                                <img src="{{url('assets/uploads/slideImages/'.$slide->picture)}}" alt="{{$slide->caption}}" title="{{$slide->caption}}" id="wows1_{{$counter}}"/>
                                                            </li>
                                                            <?php $counter++ ?>
                                                        @endforeach
                                                    @else
                                                        <li class="text-danger">No record is found</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="ws_bullets">
                                                <div>
                                                    <?php $counter=1; ?>
                                                    @foreach($slides as $slide)
                                                            <a href="#" title="{{$slide->caption}}"><span><img src="{{url('assets/uploads/slideImages/'.$slide->picture)}}" style="height: 30px" alt=""/>{{$counter}}</span></a>
                                                            <?php $counter++ ?>
                                                        @endforeach
                                                </div>
                                            </div>
                                            <div class="ws_script" style="position:absolute;left:-99%">
                                                {{--<a href="http://wowslider.net">jquery slider</a> by WOWSlider.com v8.8--}}
                                            </div>
                                            <div class="ws_shadow"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 phone-holder">
                @if(!auth()->guard('web')->check())
                <div class="iphone-mockup">
                    <div class="login-card"><img src="{{url('assets/img/avatar_2x.png')}}" class="profile-img-card">
                        <p class="profile-name-card">@include('templates.partials.alerts') </p>
                        <form class="form-signin" action="{{route('login')}}" method="post">
                            @csrf
                            <span class="reauth-email"> </span>
                            <div class="form-group">
                                @if($errors->has('email_address'))
                                    <small class="text-danger form-text">{{$errors->first('email_address')}}</small>
                                @endif
                                <input class="form-control" placeholder="Email address" name="email_address" value="{{old('email_address')}}" autofocus="" id="inputEmail">
                            </div>
                            <div class="form-group">
                                @if($errors->has('password'))
                                    <small class="text-danger form-text">{{$errors->first('password')}}</small>
                                @endif
                                <input class="form-control" type="password" name="password" placeholder="Password"  id="inputPassword">
                            </div>
                            <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit" style="background: navy">Sign in</button>
                        </form>
                        <a href="{{route('user.register')}}" class="forgot-password" style="font-size: 12px">Don't Have an Account? Register Here</a>
                    </div>
                </div>
                @else
                    <?php
                        $getAdmin=new \ProjectManagement\Models\Admin();
                        $supervisor=$getAdmin->where('privilege',1)->first();
                    ?>
                    <div class="row">
                        <div class="col col-md-5">
                            <div style="background-color:#ffffff;width:200px;margin-top: 190px">
                                <img src="{{url('assets/uploads/profileImages/'.$supervisor->picture)}}" style="height:250px;width: 100%" />
                                <h5>{{$supervisor->firstname." ".$supervisor->lastname." ".$supervisor->middlename}}</h5>
                            </div>
                        </div>
                        <div class="col offset-md-1 col-md-6">
                            <h1 class="product-text-color text-center">Project Coordinator</h1>
                            <small class="product-review d-block text-uppercase"><b>Role: </b>{{$supervisor->officeNo}}</small><br>
                            <small class="product-review d-block text-uppercase">{{$supervisor->email}}</small><br>
                            <small class="product-reviw d-block text-uppercase" style="font-size: 13px"><b>Phone number: </b>{{$supervisor->phone}}</small>
                        </div>
                    </div>
                @endif

            </div>
        </div>
@endsection