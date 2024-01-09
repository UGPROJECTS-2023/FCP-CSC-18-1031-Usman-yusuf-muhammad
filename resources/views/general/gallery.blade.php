<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 11/27/2023
 * Time: 8:12 AM
 */
?>
@extends('templates.default')
@section('content')
    @include('templates.partials.alerts')
    <div class="gallery">
        <h3 class="text-capitalize text-white mb-4 pt-5">Our Gallery</h3>

        <div class="container masonry-wrapper" style="max-width: none">
            <div class="masonry">
                @if($pictures->count() > 0)
                    @foreach($pictures as $picture)
                        <div class="masonry-item">
                            <div class="box">
                                <div class="box-img">
                                    <img src="{{url('assets/uploads/galleryImages/'.$picture->picture)}}" alt="Williamson"></div>
                                <a href="{{url('assets/uploads/galleryImages/'.$picture->picture)}}" data-lightbox="photos">
                                    <div class="box-content">
                                        <h4 class="title">{{$picture->label}}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-danger text-center">No Item is Found</div>
                @endif

            </div>
        </div>

    </div>


@endsection