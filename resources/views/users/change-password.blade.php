@extends('layouts.main')

@section('content')

<div class="w3-row-padding">

    <div class="w3-col m4">&nbsp;</div>
    <div class="w3-col m4">

        <div class="w3-card-4 w3-animate-bottom">
            <header class="w3-container w3-green">
                <h3>Change Password</h3>
            </header>

            <div class="w3-container">
                <p>
                    <strong>{{$user->fullName()}}</strong> <br>
                    <i>{{$user->school}}</i>
                </p>
            </div>

            {!! Form::open(['method'=>'patch', 'url'=>"/user/$user->id/change-password"]) !!}

            <div class="w3-container w3-padding-16">
                <p>
                    {{Form::label('password','New Password',['class'=>'w3-text-green'])}}
                    {{Form::password('password',['class'=>'w3-input'])}}
                </p>
                <p>
                    {{Form::label('password_confirmation','Confirm Password',['class'=>'w3-text-green'])}}
                    {{Form::password('password_confirmation',['class'=>'w3-input'])}}
                </p>
            </div>

            <div class="w3-padding-16 w3-green w3-container">
                <button type="submit" class="w3-button w3-right w3-pale-green">Change Password</button>
            </div>

            {!! Form::close() !!}
        </div>

    </div>

</div>

@stop
