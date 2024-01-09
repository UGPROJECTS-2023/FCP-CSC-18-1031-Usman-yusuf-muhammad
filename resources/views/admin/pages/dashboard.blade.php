<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>


    <title>{{$title}}</title>
    @include('templates.styles')
    <style>
        ul{
            margin: 0;
            padding: 0;
        }
        li{
            list-style: none;
        }
        li:hover{
            /*cursor: pointer;*/
        }
        .user-wrapper, .messages-wrapper{
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper{
            height: 500px;
        }
        .user{
            cursor: pointer;
            position: center;
            padding:5px 0;
        }
        .user:hover{
            background: #eeeeee;
        }
        .user:focus{
            background: #eeeeee;
        }
        .user:last-child{
            margin-bottom: 0;
        }
        .pending{
            position: absolute;
            left: 13px;
            top:9px;
            background: coral;
            color:white;
            border-radius:50% ;
            margin: 0;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            font-size: 12px;
        }
        .media-left{
            margin: 0 10px;
        }
        .media-left img{
            width:64px;
            border-radius: 64px;
        }
        .media-body p{
            padding: 6px 0;
        }
        .messages-wrapper{
            padding: 10px;
            height: 435px;
            background: #eeeeee;

        }
        .messages .message{
            margin-bottom: 15px;



        }
        .messages .message:last-child{
            margin-bottom: 0;
        }
        .messages .message:first-child{
            margin-top: 50px;
        }

        .received, .sent{
            width: 45%;
            background: red;
            padding: 3px 10px;
            border-radius: 10px;
            border-width: 15px 20px 0 0;

        }
        /*.clearfix:after{*/
        /*border-style: solid;*/
        /*border-width: 0 20px 15px 0;*/
        /*border-color: transparent #fff transparent transparent;*/
        /*}*/
        @media (max-width: 920px) {
            .received, .sent{
                width: 55%;
                background: red;
                padding: 3px 10px;
                border-radius: 10px;
            }

        }
        .received{
            background: #fff;
        }
        .sent{
            background: rgba(173, 181, 189, 0.47);
            float: right;
            text-align: right;
        }
        .message p{
            margin: 5px 0;
        }
        .date{
            color: #777777;
            font-size: 12px;
        }
        .active{
            background: #eeeeee;
        }
        .email{
            margin-top: -15px;
            font-size: 10px;
            opacity: 0.5;
            overflow: hidden;
            margin-left: 5%;
        }
        input[type=text]{
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus{
            border: 1px solid #aaaaaa;
        }

    </style>

</head>

<body>
<div  style="border-bottom: 2px solid black" class="row">
    <div class="col">
        <h1>ADMIN DASHBOARD</h1>
        <nav class="navbar navbar-dark navbar-expand-md sticker">
            <div class="container">
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto" style="margin-top: -70px">
                        <li class="dropdown left-tab">
                            <a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle nav-link left-tab" style="color:green">{{auth('admin')->user()->email}}</a>
                            <div role="menu" class="dropdown-menu">
                                <a role="presentation" href="{{route('admin.profile')}}" class="dropdown-item">Profile</a>
                                <a role="presentation" href="{{route('admin.logout')}}" class="dropdown-item">Logout</a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"> <a href="{{route('dashboard')}}">Dashboard </a></li>


            @if(is_null(auth()->guard('admin')->user()->privilege))
                <li> <a href="{{route('myStudents')}}">My Students</a></li>
             <!--   <li> <a href="{{route('liveChat')}}">Live Chat</a></li> -->
                <li> <a href="{{route('project')}}">Add Project Topics</a></li>
                <li> <a href="{{route('allProjects')}}">check projects </a></li>
                <li> <a href="{{route('edit')}}">Edit projects</a></li>
            @else
                <li> <a href="{{route('allocate')}}">Allocation </a></li>
                <li> <a href="{{route('allProjects')}}">projects </a></li>
                <li> <a href="{{route('student')}}#">Students </a></li>
                <li> <a href="{{route('lecturer')}}">Lecturers </a></li>
                <li> <a href="{{route('gallery')}}">Gallery Images</a></li>
                <li> <a href="{{route('slide')}}">Image SlideShow </a></li>
                <li> <a href="{{route('messages')}}">Messages </a></li>
                <li> <a href="{{route('edit')}}">Edit projects</a></li>
            @endif
        </ul>
    </div>
    <div class="page-content-wrapper" id="app">
        <div class="container-fluid"><a class="btn btn-link" role="button" href="#menu-toggle" id="menu-toggle"><i class="fa fa-bars"></i></a>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h2>{{$heading}}</h2>
                    </div>
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>
    @include('templates.scripts')
    <script>
        document.getElementById("messages").scrollTop =  document.getElementById("messages").scrollHeight
    </script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>

    <script>

        var receiver_id='';
        var my_id="{{auth()->guard('admin')->user()->id}}";
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
                    url: "message/" + receiver_id,
                    data: null,
                    cache:false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToButtomFunc();
                    },

                });
            });

            $(document).on('keyup','.input-text input',function (e) {
                var message=$(this).val();
                if(e.keyCode==13 && message != '' && receiver_id !=''){
                    $(this).val('');
                    var datastr="receiver_id=" + receiver_id + "&message=" + message;
                    $.ajax({
                        type: "post",
                        url: "{{route('sendMessage')}}",
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

</div>
</body>

</html>
