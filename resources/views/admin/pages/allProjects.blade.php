<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/26/2023
 * Time: 3:12 PM
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
                        <th>Status</th>
                        <th>Topic By</th>
                        <th>Date Added</th>
                    </tr>
                    <tr class="warning no-result">
                        <td colspan="4"><i class="fa fa-warning"></i>No result</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($projects->count()>0)
                        <?php $counter=1 ?>
                        @foreach($projects as $project)
                            <?php
                                $user=\ProjectManagement\Models\Admin::find($project->lecturer_id);
                            ?>
                            <form method="post" action="{{route('updateProject',[$project->id])}}" enctype="multipart/form-data">
                                <tr> @csrf
                                    <th scope="row">{{$counter}}</th>
                                    <td class="text-capitalize">
                                        {{$project->title}}
                                    </td>
                                    <td class="text-capitalize">
                                        {{$project->type}}
                                    </td>
                                    <td class="text-capitalize">
                                        @if(!is_null($project->project_file))
                                            <a href="{{url('assets/uploads/projectFiles/'.$project->project_file)}}">download</a><br>

                                        @else
                                            <p class="d-block">Null</p>

                                        @endif
                                    </td>
                                    <td class="text-capitalize">
                                        {{$project->description}}
                                    </td>
                                    <td>
                                        @if(!is_null($project->student_id))

                                            <span class="text-warning">Selected</span>
                                        @else
                                            <span class="text-success">Available</span>
                                        @endif
                                    </td>
                                    <td>{{$user->firstname." ".$user->lastname." ".$user->middlename}}</td>
                                    <td class="text-lowercase">{{$project->created_at}}</td>
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

        </div>
        @if(auth()->guard('admin')->user()->privilege !=1)
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('project')}}">Back to Adding Topic</a> </li>
            </ul>
        </div>
        @endif
    </div>

@endsection