<?php
/**
 * Created by VS code.
 * User: uthamn-my
 * Date: 12/7/2023
 */
?>
@extends('templates.default')
@section('content')
    @include('templates.partials.alerts')
    <h3 class="text-capitalize text-white mb-4 pt-5">Recommended Project Topics</h3>
    <div class="form-group pull-right">
        <input type="text" class="search form-control-sm" placeholder="Filter">
    </div>
    <span class="counter pull-right"></span>
    <table class="table table-hover table-bordered results text-white" style="font-size: 12px">
        <thead>
        <tr>
            <th>S/n</th>
            <th>Project Tile</th>
            <th>Project Type</th>
            <th>Project Description</th>
            <th>Project file</th>
            <th>Posted By</th>
            <th>Date Posted</th>
            <th>Select Topic</th>
            <th>Request Supervisor</th>

        </tr>
        <tr class="warning no-result">
            <td colspan="4"><i class="fa fa-warning"></i> No result</td>
        </tr>
        </thead>
        <tbody>
        @if($projects->count()>0)
            <?php
                $counter=1
            ?>
            @foreach($projects as $project)
                <?php $user=\ProjectManagement\Models\Admin::find($project->lecturer_id) ;?>
                <tr>
                    <th scope="row">{{$counter}}</th>
                    <td>{{$project->title}}</td>
                    <td>{{$project->type}}</td>
                    <td>{{$project->description}}</td>
                    <td>
                        @if($project->project_file != null)
                            <a href="{{url('assets/uploads/projectFiles/'.$project->project_file)}}">Download</a>
                        @else
                            <span class="text-danger">NIL</span>
                        @endif
                    </td>
                    
                  <td class="text-capitalize">{{$user->firstname." ".$user->lastname." ".$user->middlename}}</td>
                    <td>{{$project->created_at}}</td> 
                    <td>
                        @if($project->student_id == null)
                        <a href="{{route('requestTopic',[$project->id])}}" class="btn btn-success">Select</a>
                        @else
                            @if($project->student_id==auth()->guard('web')->user()->id)
                                <span class="text-danger">Selected by you</span>

                            @else
                                <span class="text-danger">Selected</span>

                            @endif
                        @endif
                    </td>
                    <td>
                        @if($project->student_id == null)
                            <a href="{{route('requestSupervisor',[$project->id])}}" class="btn btn-info">Request</a>

                        @elseif($project->student_id == auth()->guard('web')->user()->id && is_null($project->status))
                            <a href="{{route('requestSupervisor',[$project->id])}}" class="btn btn-info">Request</a>
                        @else
                            @if($project->student_id==auth()->guard('web')->user()->id)
                            <button href="#" class="btn btn-info" disabled>Requested by you</button>
                            @else
                                <button href="#" class="btn btn-info" disabled>Requested</button>

                            @endif
                        @endif
                    </td>

                </tr>
                <?php $counter++ ?>
            @endforeach
        @else
        <tr>
            <th scope="row" class="text-danger">No project is found</th>
        </tr>
        @endif
        <tr>
            <th scope="row">{{$projects->render()}}</th>

        </tr>
        </tbody>
    </table>
    <div class="pb-5"></div>
@endsection