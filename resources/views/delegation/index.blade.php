@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m1">&nbsp;</div>

    <div class="w3-col m10 w3-animate-bottom">
        <div class="w3-right">
            <a href='{{url("/user/create")}}' class="w3-button w3-green">+ Create</a>
            <a href='{{url("/user/import-form")}}' class="w3-button w3-green">Import..</a>
        </div>
        <h3>List of Delegates</h3>
        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>School</th>
                    <th>School Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index=>$user)

                <tr>
                    <td>{{$index+1}}.</td>
                    <td>{{$user->fullName()}}</td>
                    <td>{{$user->designation}}</td>
                    <td>{{$user->school}}</td>
                    <td>
                        {{$user->school_address}}
                        <a href='{{url("/profile/$user->id")}}' class="w3-button w3-right w3-round w3-green" style="padding: 2px 10px">&gt;</a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
