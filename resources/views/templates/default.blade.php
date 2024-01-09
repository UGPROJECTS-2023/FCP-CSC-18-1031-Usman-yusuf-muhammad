<?php
/**
 * User: uthman my
 * Date: 10/23/2023
 
 */
?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>


    <title>{{$title}}</title>

    @include('templates.styles')
</head>
<body>
@include('templates.partials.header')


<div id="home">
    <div class="header-blue">
        <div class="container hero" style="/*border:solid red 1px;*/margin-top:0;margin-bottom:0;">

        @yield('content')
        </div>
    </div>
</div>
@include('templates.partials.footer')
@include('templates.scripts')
<script>
    document.getElementById("messages").scrollTop =  document.getElementById("messages").scrollHeight
</script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{url('assets/js/jquery.min.js')}}"></script>
<script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>
{{--<script src="{{url('assets/js/Table-with-search.js')}}"></script>--}}
<script>

    var receiver_id='';
    @if(auth()->guard('web')->check())
    var my_id="{{auth()->guard('web')->user()->id}}";
    @endif
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Pusher.logToConsole = true;

        var pusher = new Pusher('7aacc0665cfd280b8133', {
            cluster: 'ap4'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));

            if(my_id == data.origin){
                $('#' + data.destination).click();
            }
            else if(my_id == data.destination){
                if(receiver_id == data.origin){
                    $('#' + data.origin).click();
                }else{
                    var pending=parseInt($('#' + data.origin).find('.pending').html());
                    if(pending){
                        $('#' + data.origin).find('.pending').html(pending + 1);
                    }else{
                        $('#' + data.origin).append('<span class="pending">1</span>')
                    }
                }
            }
        });

        $(".user").click(function(){
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();
            receiver_id=$(this).attr('id');
            $.ajax({
                type: "GET",
                url: "supervisor/" + receiver_id,
                data: null,
                cache:false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToButtomFunc();
                }
            });
        });

        $(document).on('keyup','.input-text input',function (e) {
            var message=$(this).val();
            if(e.keyCode==13 && message != '' && receiver_id !=''){
                $(this).val('');
                var datastr="receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "{{route('user.sendMessage')}}",
                    data: datastr,
                    cache:false,
                    success:function (data) {
                    },
                    error:function(jqXHR, status, err){
                    },
                    complete:function () {
                        scrollToButtomFunc();
                    },
                });
            }
        })
    });
    function scrollToButtomFunc() {
        $('.messages-wrapper').animate({
            scrollTop:$('.messages-wrapper').get(0).scrollHeight
        },50);
    }
</script>
</body>
</html>

