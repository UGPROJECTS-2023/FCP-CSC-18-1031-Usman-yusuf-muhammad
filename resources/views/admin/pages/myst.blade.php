<?php
/**
 * Created by vs code.
 * User: uthman-my
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header"><h4 class="text-capitalize text-center">my students</h4></div>
                @if($allocations->count()>0)

                    <div class="card-body">
                        @foreach($allocations as $allocation)
                            <?php
                                $students=\ProjectManagement\Models\User::where('id',$allocation->student_id)->first();
                            ?>
                               <div class="row mb-4" style="border-bottom: 2px solid black">
                                   <div class="col col-sm-6">
                                       <span class="d-block text-capitalize"><b>Name: </b>{{$students->firstName." ".$students->lastName." ".$students->middleName}} </span>
                                       <span class="d-block text-uppercase"><b>RegNo: </b> {{$students->regNo}}</span>
                                       <span class="d-block"><b>Email: </b> {{$students->email}}</span>
                                       <span class="d-block"><b>Phone: </b> 0{{$students->phone}}</span>
                                   </div>
                                   <div class="col col-sm-6">
                                       @if(!is_null($students->picture))
                                           <img src="{{url('assets/uploads/profileImages/'.$students->picture)}}" style="width: 100%">
                                       @else
                                            <i class="fa fa-user fa-3x text-primary"></i>
                                       @endif
                                   </div>
                               </div>
                        @endforeach
                    </div>
                @else
                    <span class="text-danger">You have no any student yet</span>
                @endif
            </div>
        </div>
    </div>
@endsection
