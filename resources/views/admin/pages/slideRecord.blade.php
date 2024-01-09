<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/25/2023
 * Time: 9:59 PM
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
                <h4 class="text-capitalize text-center">Slide Images record</h4>
                @include('templates.partials.alerts')
                <table class="table table-hover table-bordered results">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Caption</th>
                        <th>Delete</th>
                    </tr>
                    <tr class="warning no-result">
                        <td colspan="4"><i class="fa fa-warning"></i>No result</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($slides->count()>0)
                        <?php $counter=1 ?>
                        @foreach($slides as $slide)
                            <tr>
                                <th scope="row">{{$counter}}</th>
                                <td class="text-capitalize"><img src="{{url('assets/uploads/slideImages/'.$slide->picture)}}" style="width:70px;height:70px"></td>
                                <td class="text-uppercase">{{$slide->caption}}</td>
                                <td class="text-lowercase"><a href="{{route('deleteSlide',[$slide->id])}}" class="btn btn-danger">Delete</a></td>
                                {{--<td>--}}
                                    {{--<a href="#remove{{$counter}}" class="btn btn-danger" data-toggle="modal">Delete</a>--}}
                                    {{--<div role="dialog" tabindex="-1" class="modal fade" id="remove{{$counter}}" style="width:400px;height:250px;overflow:hidden;margin:50px auto;text-transform:capitalize;">--}}
                                        {{--<div class="modal-dialog" role="document">--}}
                                            {{--<div class="modal-content alert alert-danger" role="alert" >--}}
                                                {{--<div class="modal-header p-0">--}}
                                                    {{--<strong class="text-capitalize text-center"><i class="fa fa-warning"></i> Warning!!</strong><br>--}}
                                                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-body p-2 text-black">--}}
                                                    {{--<span>Do you really want to delete <b class="text-uppercase">{{$user->regNo}}</b> from this record?</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-footer p-0">--}}
                                                    {{--<button class="btn btn-light p-1" type="button" data-dismiss="modal" style="font-size: 14px">Cancel</button>--}}
                                                    {{--<a href="{{route('deleteLecturer',['delete'=>$user->id])}}" class="btn btn-light text-danger p-1"  style="font-size: 14px">Remove</a></div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</td>--}}

                            </tr>
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
        <div class="col col-md-2" style="border-left:3px solid black">
            <ul>
                <li><a href="{{route('slide')}}">Back to Upload Slide</a> </li>
            </ul>
        </div>
    </div>
@endsection
