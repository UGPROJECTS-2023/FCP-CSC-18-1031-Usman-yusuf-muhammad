<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/27/2023
 * Time: 7:39 AM
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row my-5">
        <div class="col col-md-7">
            <div class="row register-form">
                <div class="col-md-10 offset-md-1">
                    @include('templates.partials.alerts')
                    <form class="custom-form" action="{{route('gallery')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row form-group">

                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Gallery Image </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="file" name="picture"></div>
                            @if($errors->has('picture'))
                                <small class="text-danger">{{$errors->first('picture')}}</small>
                            @endif
                        </div>
                        <div class="form-row form-group">

                            <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Image Label </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="text" placeholder="Label" name="label" value="{{old('label')}}"></div>
                            @if($errors->has('label'))
                                <small class="text-danger">{{$errors->first('label')}}</small>
                            @endif
                        </div>
                        <button class="btn btn-light submit-button" type="submit">Submit Form</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col col-md-5" style="border-left:3px solid black">
            @if($images->count()>0)
                <div>
                    <div class="form-group pull-right">
                        <input type="text" class="search form-control" placeholder="What you looking for?" />
                    </div>
                    <span class="counter pull-right"></span>
                    <h4 class="text-capitalize text-center">Gallery Images record</h4>
                    @include('templates.partials.alerts')
                    <table class="table table-hover table-bordered results">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Label</th>
                            <th>Delete</th>
                        </tr>
                        <tr class="warning no-result">
                            <td colspan="4"><i class="fa fa-warning"></i>No result</td>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $counter=1 ?>
                            @foreach($images as $image)
                                <tr>
                                    <th scope="row">{{$counter}}</th>
                                    <td class="text-capitalize"><img src="{{url('assets/uploads/galleryImages/'.$image->picture)}}" style="width:70px;height:70px"></td>
                                    <td class="text-capitalize">{{$image->label}}</td>
                                    <td class="text-lowercase"><a href="{{route('deleteImage',[$image->id])}}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                <?php $counter++?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>{{$images->render()}}</div>
            @else
            <span class="text-danger">No record is found</span>
            @endif
        </div>
    </div>
@endsection
