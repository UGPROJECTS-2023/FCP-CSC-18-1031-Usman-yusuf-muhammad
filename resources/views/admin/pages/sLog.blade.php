<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 1/2nd/2024
 */
?>
@extends('admin.pages.dashboard')
@section('contents')

    <div class="row my-5">
        <div class="col col-md-10-2">
            <div>
                <div class="form-group pull-right">
                    <input type="text" class="search form-control" placeholder="What you looking for?" />
                </div>
                <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered results">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Full-name</th>
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
                            $userObj=\ProjectManagement\Models\User::find($user->user_id);
                            ?>
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td class="text-capitalize">{{$userObj->firstName." ".$userObj->lastName." ".$userObj->middleName}}</td>
                                <td class="text-capitalize">{{$user->action}}</td>
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
                <li><a href="{{route('student')}}">Back to Students Record</a> </li>
            </ul>
        </div>
    </div>

@endsection