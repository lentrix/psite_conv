@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
        <div class="w3-col m3">&nbsp;</div>
        <div class="w3-col m6">
            <div class="w3-card-4 w3-animate-bottom">
                <header class="w3-container w3-green">
                    <h3>New Delegate</h3>
                </header>

                {!! Form::open(['url'=>"/user/create", 'method'=>'post']) !!}
                <div class="w3-row-padding">
                    <p class="w3-container w3-col m6">
                        {{Form::label('lname',"Last Name",['class'=>'w3-text-green'])}}
                        {{Form::text('lname',null,['class'=>'w3-input w3-border'])}}
                    </p>
                    <p class="w3-container w3-col m6">
                        {{Form::label('fname',"First Name",['class'=>'w3-text-green'])}}
                        {{Form::text('fname',null,['class'=>'w3-input w3-border'])}}
                    </p>
                </div>
                <div class="w3-row-padding">
                    <p class="w3-container w3-col m6">
                        {{Form::label('email','Email',['class'=>'w3-text-green'])}}
                        {{Form::email('email',null,['class'=>'w3-input w3-border'])}}
                    </p>
                    <p class="w3-container w3-col m6">
                        {{Form::label('designation','Designation',['class'=>'w3-text-green'])}}
                        {{Form::text('designation',null,['class'=>'w3-input w3-border'])}}
                    </p>
                </div>
                <div class="w3-row-padding">
                    <p class="w3-container w3-col m6">
                        {{Form::label('gender','Gender',['class'=>'w3-text-green'])}}
                        {{Form::select('gender',['m'=>'Male','f'=>'Female'],null,['class'=>'w3-input','placeholder'=>'Select gender'])}}
                    </p>
                    <p class="w3-container w3-col m6">
                        {{Form::label('password','Password',['class'=>'w3-text-green'])}}
                        {{Form::password('password_confirmation',['class'=>'w3-input w3-border'])}}
                    </p>
                </div>
                <p class="w3-container">
                    {{Form::label('school','School',['class'=>'w3-text-green'])}}
                    {{Form::text('school',null,['class'=>'w3-input w3-border'])}}
                </p>
                <p class="w3-container">
                    {{Form::label('school_address','School Address',['class'=>'w3-text-green'])}}
                    {{Form::text('school_address',null,['class'=>'w3-input w3-border'])}}
                </p>

                <div class="w3-container w3-green w3-padding-16 w3-row-padding">
                    <div class="w3-col m8">&nbsp;</div>

                    <div class="w3-col m4 w3-mobile">
                        <button type="submit" class="w3-button w3-pale-green w3-block">
                            Update User Profile
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
