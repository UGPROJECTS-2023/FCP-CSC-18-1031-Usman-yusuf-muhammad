<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 10/27/2023
 * Time: 8:12 AM
 */
?>
@extends('templates.default')
@section('content')
    @include('templates.partials.alerts')
    <section>
        <div class="container py-5" style="max-width: none">
            <div class="photo-card">
                <?php
                    $getSlide= new \ProjectManagement\Models\Slide();
                    if(!is_null($getSlide)){
                        $image=$getSlide->inRandomOrder()->first();
                    }
                ?>
                <div class="photo-background" @if(!is_null($getSlide))style="background-image:url({{url('assets/uploads/slideImages/'.$image->picture)}});"@endif></div>
                <div class="photo-details">
                    <div id="minimal-tabs">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">About us</a></li>
                            <li class="nav-item" style="border-left: 1px solid white;border-right: 1px solid white"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Mission</a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3">Vision</a></li>
                        </ul>
                        <div class="tab-content" style="">
                            <div class="tab-pane active" role="tabpanel" id="tab-1"  style="">
                                <h4  style="color: orangered;background: white" class="mt-0">About us</h4>
                                <p style="color: black;background: white;text-align: justify">
                                    The Kano State zoological system is in side-line with the traditional way of conveying zoological activities such as ticket
                                    purchasing, events space booking and scheduling, tracking animals record and announcements of upcoming events.
                                </p>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab-2">
                                <h4  style="color: orangered;background: white" class="mt-0">Mission</h1>
                                <p></p>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="tab-3">
                                <h4  style="color: orangered;background: white" class="mt-0">Vision</h1>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
