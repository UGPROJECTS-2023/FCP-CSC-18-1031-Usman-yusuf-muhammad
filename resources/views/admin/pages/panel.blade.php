<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 1st/02/2024
 * 
 */
?>
@extends('admin.pages.dashboard')
@section('contents')
    <div class="row">
        <div class="col">
            <section class="wrapper-numbers">
                <div class="container">
                    @if(auth()->guard('admin')->user()->privilege==1)
                    <div class="row countup text-center">
                        <div class="col-md-8 offset-md-2 header-numbers">
                            <h1>coordinator's panel</h1>
                            <p>conduct your project on the go!!</p>
                        </div>
                        <div class="col-sm-6 col-md-3 column">
                            <?php
                                $getUser=new \ProjectManagement\Models\User();
                                $student=$getUser->get();
                            ?>
                            <p><i class="icon-graduation" aria-hidden="true"></i></p>
                            <p><span class="count">{{$student->count()}}</span></p>
                            <h2>Total Students</h2>
                        </div>
                        <div class="col-sm-6 col-md-3 column">
                            <?php
                            $getUser=new \ProjectManagement\Models\Admin();
                            $lecturer=$getUser->get();
                            ?>
                            <p><i class="icon-user" aria-hidden="true"></i></p>
                            <p><span class="count replay">{{$lecturer->count()}}</span></p>
                            <h2>Total Lecturers</h2>
                        </div>
                        <div class="col-sm-6 col-md-3 column">
                            <?php
                            $getAllocation=new \ProjectManagement\Models\Allocation();
                            $allocation=$getAllocation->get();
                            ?>
                            <p><i class="icon-reload" aria-hidden="true"></i></p>
                                <p><span class="count">{{$allocation->count()}}</span></p>
                            <h2>Allocation</h2>
                        </div>
                        <div class="col-sm-6 col-md-3 column">
                            <?php
                            $getAllProjects=new \ProjectManagement\Models\Projects();
                            $projects=$getAllProjects->get();
                            ?>
                            <p><i class="icon-book-open" aria-hidden="true"></i></p>
                            <p><span class="count">{{$projects->count()}}</span></p>
                            <h2>Project Topics</h2>
                        </div>
                    </div>
                    @else
                        <div class="row countup text-center">
                            <div class="col-md-8 offset-md-2 header-numbers">
                            <h1>supervisor's panel</h1>
                            <p>conduct your project on the go!!</p>
                            </div>
                            <div class="col-sm-6 col-md-4 column">
                                <?php
                                $getAllocated=new \ProjectManagement\Models\Allocation();
                                $myStudents=$getAllocated->where('lecturer_id',auth()->guard('admin')->user()->id)->get();
                                ?>
                                <p><i class="icon-graduation" aria-hidden="true"></i></p>
                                <p><span class="count">{{$myStudents->count()}}</span></p>
                                <h2>My Students</h2>
                            </div>
                            <div class="col-sm-6 col-md-4 column">
                                <?php
                                $getProjects=new \ProjectManagement\Models\Projects();
                                $myProject=$getProjects->where('lecturer_id',auth()->guard('admin')->user()->id)->get();
                                ?>
                                <p><i class="icon-user" aria-hidden="true"></i></p>
                                <p><span class="count replay">{{$myProject->count()}}</span></p>
                                <h2>My Project Topics</h2>
                            </div>
                            <div class="col-sm-6 col-md-4 column">
                                <?php
                                $getAllProjects=new \ProjectManagement\Models\Projects();
                                $projects=$getAllProjects->get();
                                ?>
                                <p><i class="icon-book-open" aria-hidden="true"></i></p>
                                <p><span class="count">{{$projects->count()}}</span></p>
                                <h2>All Project Topics</h2>
                            </div>

                        </div>
                    @endif
                </div>
            </section>

        </div>

    </div>
@endsection
