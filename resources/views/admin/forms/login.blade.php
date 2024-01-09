<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/2/2023
 */
?>
@include('templates.styles')
@include('templates.partials.alerts')
<div class="head", style=" background-color:rgb(21, 39, 111); color:#ffff; border:1px solid black; hiegh:250px; width:1350px; display:inline-flex; border-radius: 10px 40px 10px 50px; padding 5px;" >
        <img style="width:150px; hieght:250px; padding-top:20px; margin-left:30px;" src="{{url('assets/img/FUD-removebg-preview.png')}}" > <br><br>
        <h2 style=" margin-left:50px; margin-top:50px;">  Faculty of computing<br> projector </h2>
    </div>


<h3 style="position:center;">Coordinator's/ Supervisor's Login Page</h3>
<div class="login-card"><img src="{{url('assets/img/avatar_2x.png')}}" class="profile-img-card">

    <form class="form-signin" method="post" action="{{route('admin.login')}}">
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

        <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit"style="background-color:rgb(21, 39, 111);">Sign in</button>
    </form>
    <a href="{{route('admin.register')}}" class="forgot-password">Don't Have an Account? Register Here</a>
</div>
@include('templates.scripts')


