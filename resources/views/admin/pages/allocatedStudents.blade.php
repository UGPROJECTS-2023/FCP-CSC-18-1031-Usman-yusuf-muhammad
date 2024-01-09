<?php
/**
 * Created by vs code.
 * User: uthman-my
 * Date: 12/25/2023
 */
?>

@extends('admin.pages.dashboard')
@section('contents')
<div class="row my-5">
    <div class="col col-md-10">
        <table class="table table-bordered">
            <thead class="text-center">
            <tr>
                <th>Student Name</th>
                <th>Student RegNo</th>
                <th>Supervisor</th>
            </tr>

            </thead>
            <tbody>
            @foreach($allocation as $allocations)
                <?php
                $allocating=$allocations->allocation;
                ?>
                @foreach($allocating as $allocation)

                    <?php
                    $userObj=\ProjectManagement\Models\User::find($allocation->student_id);

                    ?>
                    <tr>
                        {{--<td></td>--}}
                        <td class="text-capitalize">{{$userObj->firstName." ".$userObj->lastName." ".$userObj->middleName}}</td>
                        <td class="text-uppercase">{{$userObj->regNo}}</td>
                        <td class="text-capitalize">{{$allocations->firstname." ".$allocations->lastname." ".$allocations->middlename}}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col col-md-2" style="border-left:3px solid black">
        <ul>
            <li><a href="{{route('allocate')}}"> Back to Allocation</a> </li>
        </ul>
    </div>
</div>
@endsection