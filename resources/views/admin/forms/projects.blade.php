<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/17/2023
 * Time: 8:48 PM
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row my-5 register-form">
        <div class="col col-md-10">
            @include('templates.partials.alerts')
            <form class="custom-form" method="post" action="{{route('project')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div  class="col col-md-12">
                        <div class="form-row form-group">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Project Type</label></div>
                            <div class="col-sm-8 input-column">
                                @if($errors->has('project_type'))
                                    <small class=" text-danger">{{$errors->first('project_type')}}</small>
                                @endif
                                <select class="form-control" name="project_type">
                                    <option value=" " selected>Select Project Type</option>
                                    <option value="hardware">Hardware</option>
                                    <option value="standalone">Stand Alone Software</option>
                                    <option value="android">Android Application</option>
                                    <option value="web">Web Application</option>
                                    <option value="distributed">Distributed Application</option>
                                    <option value="Artificial">Artificial Intelligent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Project Title</label></div>
                            <div class="col-sm-8 input-column">
                                @if($errors->has('project_title'))
                                    <small class=" text-danger">{{$errors->first('project_title')}}</small>
                                @endif
                                <input class="form-control" type="text" name="project_title" value="{{old('project_title')}}">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Project File</label></div>
                            <div class="col-sm-8 input-column">
                                @if($errors->has('project_file'))
                                    <small class=" text-danger">{{$errors->first('project_file')}}</small>
                                @endif
                                <input class="form-control" type="file" name="project_file">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-sm-3 label-column"><label class="col-form-label" for="email-input-field">Project Description</label></div>
                            <div class="col-sm-8 input-column">
                                @if($errors->has('project_description'))
                                    <small class=" text-danger">{{$errors->first('project_description')}}</small>
                                @endif
                                <textarea class="form-control"  name="project_description">{{old('project_description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-light submit-button" type="submit">Add Topic</button>
            </form>

        </div>
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('myProjects')}}">My Uploaded Projects</a> </li>
                <li><a href="{{route('allProjects')}}">All Uploaded Projects</a> </li>
            </ul>
        </div>
    </div>

@endsection
