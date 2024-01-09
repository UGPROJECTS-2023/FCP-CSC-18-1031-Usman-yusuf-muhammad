<?php
/**
 * Created by vs code.
 * User: uthmam-my
 * Date: 12/26/2023
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
@include('templates.partials.alerts')
    <div class="row my-5">
        <div class="col col-md-10">
            <div>
                <div class="form-group pull-right">
                    <input type="text" class="search form-control" placeholder="What you looking for?" />
                </div>
                <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered table-sm results">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Project Title</th>
                        <th>Project Type</th>
                        <th>File</th>
                        <th>Description</th>
                        <th>Date Added</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                    <tr class="warning no-result">
                        <td colspan="4"><i class="fa fa-warning"></i>No result</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($projects->count()>0)
                        <?php $counter=1 ?>
                        @foreach($projects as $project)
                            <form method="post" action="{{route('updateProject',[$project->id])}}" enctype="multipart/form-data">
                            <tr> @csrf
                                <th scope="row">{{$counter}}</th>
                                <td class="text-capitalize">
                                    <input type="text" class="form-control-sm" value="{{$project->title}}" name="project_title">
                                </td>
                                <td class="text-capitalize">
                                    <select class="form-control-sm" name="project_type">
                                        <option value=" ">Select Project Type</option>
                                        <option value="hardware" @if($project->type=="hardware")selected @endif>Hardware</option>
                                        <option value="standalone" @if($project->type=="standalone")selected @endif>Stand Alone Software</option>
                                        <option value="android" @if($project->type=="android")selected @endif>Android Application</option>
                                        <option value="web" @if($project->type=="web")selected @endif>Web Application</option>
                                        <option value="distributed" @if($project->type=="distributed")selected @endif>Distributed Application</option>
                                        <option value="Artificial" @if($project->type=="Artificial")selected @endif>Artificial Intelligent</option>
                                    </select>
                                </td>
                                <td class="text-capitalize">
                                    @if(!is_null($project->project_file))
                                        <a href="{{url('assets/uploads/projectFiles/'.$project->project_file)}}">{{$project->title}}</a><br>
                                        <input type="file" name="project_file" class="form-control-sm"  style="max-width: 90px"/>

                                    @else
                                        <p class="d-block">Null</p>
                                        <input type="file" name="project_file" class="form-control-sm" style="max-width: 90px"/>

                                    @endif
                                </td>
                                <td class="text-capitalize">
                                    <textarea name="description" class="form-control-sm">{{$project->description}}</textarea>
                                </td>
                                <td class="text-lowercase">{{$project->created_at}}</td>
                                <td class="text-capitalize"><a href="{{route('deleteProject',[$project->id])}}" class="text-danger">Delete</a> </td>
                                <td class="text-capitalize"><button type="submit" class="btn btn-success">Update</button></td>
                            </tr>
                            </form>
                            <?php $counter++?>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-danger">Sorry no Record Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                <table class="table table-striped table-dark table-responsive table-bordered table-hover">
                    <thead>
                    <th>Students Requested to Work With you</th>
                    <th>Reject</th>
                    <th>Accept</th>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <?php $user=\ProjectManagement\Models\User::where('id',$project->student_id)->first(); ?>
                            <td class="text-capitalize">
                                @if(!is_null($user))
                                    {{$user->firstName." ".$user->lastName." ".$user->middleName." "."with regNo"." ".$user->regNo." "."selected a project topic titled"." ".$project->title." "."and requested for your supervision"}}
                                @endif
                            </td>
                                @if(!is_null($user))
                                    @if($project->status==3)
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm">Reject</a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm">Accept</a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{route('rejectRequest',[$project->id])}}" class="btn btn-danger btn-sm">Reject</a>
                                        </td>
                                        <td>
                                            <a href="{{route('acceptRequest',[$project->id])}}" class="btn btn-success btn-sm">Accept</a>
                                        </td>
                                    @endif
                                @endif
                            @if($project->status==3)
                                    <td><span class="text-info">Request Approved</span></td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('project')}}">Back to Adding Topic</a> </li>
            </ul>
        </div>
    </div>

@endsection
