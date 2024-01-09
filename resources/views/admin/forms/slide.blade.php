<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/24/2023
 * Time: 5:37 AM
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
<div class="row my-5">
    <div class="col col-md-10">
        <div class="row register-form">
            <div class="col-md-10 offset-md-1">
                @include('templates.partials.alerts')
                <form class="custom-form" action="{{route('slide')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row form-group">

                        <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Slide Image </label></div>
                        <div class="col-sm-6 input-column"><input class="form-control" type="file" name="picture"></div>
                        @if($errors->has('picture'))
                            <small class="text-danger">{{$errors->first('picture')}}</small>
                        @endif
                    </div>
                    <div class="form-row form-group">

                        <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Image Caption </label></div>
                        <div class="col-sm-6 input-column"><input class="form-control" type="text" placeholder="Caption" name="caption" value="{{old('caption')}}"></div>
                        @if($errors->has('caption'))
                            <small class="text-danger">{{$errors->first('caption')}}</small>
                        @endif
                    </div>
                    <button class="btn btn-light submit-button" type="submit">Submit Form</button>
                </form>
            </div>
        </div>

    </div>
    <div class="col col-md-2" style="border-left:3px solid black">
        <ul>
            <li><a href="{{route('slideRecord')}}">Slide Records</a> </li>
        </ul>
    </div>
</div>
@endsection
