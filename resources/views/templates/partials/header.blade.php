<?php
/**
 * Created by PhpStorm.
 * User: UTHMAN-MY
 * Date: 10/23/2023
 
 */
?>
<div id="home">
    <div class="header-blue" style="margin-top: -30px">
        <nav class="navbar navbar-dark navbar-expand-md sticker" style="padding-top:0px;z-index:99;">
            <div class="container"> <img style="width:100px; hieght:150px; padding-top:20px;" src="{{url('assets/img/FUD-removebg-preview.png')}}">
                <span class="text-center" href="#" style="font-size:30px;font-weight: bolder;color:navy;text-shadow: 1px 2px darkslateblue">FACULTY OF COMPUTING <br/> FEDERAL UNIVERSITY, DUTSE</span>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" style="color:black" href="{{route('homepage')}}" target="_top">Home </a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" style="color:black" href="{{route('user.gallery')}}">Gallery </a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" style="color:black;border: 1px solid #006a00" href="{{route('user.projects')}}">Recommended Projects</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" style="color:black" href="{{route('contact')}}">Contact </a></li>
                        @if(auth()->guard('web')->check())
                            <li class="dropdown left-tab" style="position: absolute;top:0;right: 0">
                                <a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle nav-link left-tab" style="color: #006a00;font-weight: bolder">{{auth()->guard('web')->user()->email}}</a>
                                <div role="menu" class="dropdown-menu">
                                    <a role="presentation" href="{{route('mySupervisor')}}" class="dropdown-item">My Supervisor</a> 
                                    <a role="presentation" href="{{route('user.profile')}}" class="dropdown-item">Profile Update</a>
                                    <a role="presentation" href="{{route('user.logout')}}" class="dropdown-item">Logout</a></div>
                                    
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

