<?php
/**
 * Created by PhpStorm.
 * User: uthman-my
 * Date: 12/10/2023
 * Time: 1:16 PM
 */
?>

@if(Session::has('failure') || isset($failure))
    <div class="row" id="alerter2" style="z-index: 3000; position: absolute;margin-top: 20px;width:100%">
        <div class="col-sm-10 col-md-6 offset-sm-1 offset-md-3" style="z-index: 9999; position: absolute;margin-top: 20px;width:100%">
            <div role="alert" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="alert-heading">
                    @if(Session::has('failure'))
                        <span style="font-weight: bolder"><i class="fa fa-warning"></i>{{Session::get('failure')['heading']}}</span>
                    @else
                        {{$failure['heading']}}
                    @endif

                </h4><span><strong>@if(Session::has('failure'))
                            {{Session::get('failure')['body']}}
                        @else
                            {{$failure['body']}}
                        @endif</strong></span></div>
        </div>
    </div>
@elseif(Session::has('success') || isset($success))
    <div class="row" id="alerter2" style="z-index: 3000; position: absolute;margin-top: 20px;width:100%">
        <div class="col-sm-10 col-md-6 offset-sm-1 offset-md-3" style="z-index: 3000">
            <div role="alert" class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="alert-heading">@if(Session::has('success'))
                        <span style="font-weight: bolder"><i class="fa fa-venus"></i>{{Session::get('success')['heading']}}</span>
                    @else
                        {{$success['heading']}}
                    @endif
                </h4><span><strong>
                        @if(Session::has('success'))
                            {{Session::get('success')['body']}}
                        @else
                            {{$success['body']}}
                        @endif
                    </strong></span></div>
        </div>
    </div>
@endif
