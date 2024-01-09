<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/28/2023
 * Time: 7:50 AM
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row my-5">
        <div class="col col-md-10">
            <div>
                <div class="form-group pull-right">
                    <input type="text" class="search form-control" placeholder="What you looking for?" />
                </div>
                <span class="counter pull-right"></span>
                <h3 class="mt-3 text-center">Lecturers Activity Logs</h3>
                <table class="table table-hover table-bordered results">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Full-name</th>
                        <th>Privilege</th>
                        <th>Action</th>
                        <th>Date</th>
                    </tr>
                    <tr class="warning no-result">
                        <td colspan="4"><i class="fa fa-warning"></i>No result</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users->count()>0)
                        <?php $counter=1 ?>
                        @foreach($users as $user)
                            <?php
                                $userObj=\ProjectManagement\Models\Admin::find($user->user_id);
                            ?>
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td class="text-capitalize">{{$userObj->firstname." ".$userObj->lastname." ".$userObj->middlename}}</td>
                                <td class="text-capitalize">{{$user->action}}</td>
                                <td class="text-capitalize">
                                    @if($user->type==1)
                                        <span class="text-danger">Admin</span>
                                    @elseif($user->type==2)
                                        <span class="text-success">Lecturer</span>
                                    @else
                                        <span>Admin/Lecturer</span>
                                    @endif
                                </td>
                                <td class="text-lowercase">{{$user->created_at}}</td>
                            </tr>
                            <?php $counter++?>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-danger">Sorry no Record Found</td>
                        </tr>
                    @endif
                    <tr>
                        <td>{{$users->render()}}</td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('lecturer')}}">Back to Lecturer Record</a> </li>
            </ul>
        </div>
    </div>
@endsection
