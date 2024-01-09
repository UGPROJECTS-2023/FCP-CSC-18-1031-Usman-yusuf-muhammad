<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/24/2023
 */
?>
<style>

    .allocation:hover{
        background: #000;
        color:green;
        transition: .5s ease-in-out;
    }
    .allocation{
        background: green;
        color: white;
    }
</style>
@extends('admin.pages.dashboard')
@section('contents')
    @include('templates.partials.alerts')
    <div class="row my-5">
        <div class="col col-md-10">
            <div class="row register-form">
                <div class="col-md-10 offset-md-1">
                    <form class="custom-form" method="post" action="{{route('allocator')}}">
                        @csrf
                        <a  class="btn allocation" href="#number" data-toggle="modal" style="height: 400px;width: 400px;border-radius: 50%;padding-top: 25%;font-weight: 800;font-size: 49px">Allocate Now!</a>

                        <div role="dialog" tabindex="-1" class="modal fade" id="number" style="width:400px;height:250px;overflow:hidden;margin:50px auto;text-transform:capitalize;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content alert alert-danger" role="alert">
                                    <div class="modal-header p-0">
                                        <strong class="text-capitalize text-center">Number of Students Assigning</strong><br>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body p-2 text-black">
                                        <input type="number" class="form-control" name="number_of_students" value="{{old('number_of_students')}}" placeholder="Number of Students Per Supervisor">
                                    </div>
                                    <div class="modal-footer p-0">
                                        <button class="btn btn-success p-1" type="submit" style="font-size: 14px">Go!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="div mt-5">
                        <h4>Student/Lecturer Agreed to Work Together</h4>
                        <table class="table table-striped">
                            <thead>
                            <th>S/n</th>
                            <th>Student Name</th>
                            <th>Student RegNo</th>
                            <th>Requested supervisor</th>
                            <th>Project Topic</th>
                            <th>Reject</th>
                            <th>Approve</th>
                            </thead>
                            <tbody>
                            <?php $counter=1 ?>
                            @foreach($projects as $project)
                                <tr>
                                <?php
                                $student=\ProjectManagement\Models\User::find($project->student_id);
                                $lecturer=\ProjectManagement\Models\Admin::find($project->lecturer_id);
                                ?>
                                    <th>{{$counter}}</th>
                                    <td>{{$student->firstName." ".$student->lastName." ".$student->middleName}}</td>
                                    <td>{{$student->regNo}}</td>
                                    <td>{{$lecturer->firstname." ".$lecturer->lastname." ".$lecturer->middlename}}</td>
                                    <td>{{$project->title}}</td>
                                    <td><a href="{{route('rejectAllocation',[$project->id])}}" class="btn btn-sm btn-danger">Reject</a> </td>
                                    <td><a href="{{route('approveAndAllocate',[$project->id])}}" class="btn btn-sm btn-success">Approve</a> </td>
                                <?php $counter++ ?>
                            @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('allocated')}}">Allocated Students</a> </li>
            </ul>
        </div>
    </div>
@endsection
