@extends('layouts.main')

@section('content')
<div class="w3-row-padding">
    <div class="w3-col m4">&nbsp;</div>
    <div class="w3-col m4">
        <div class="w3-card-4 w3-animate-bottom">

            <header class="w3-container w3-green">
                <h2>User Login</h2>
            </header>

            {!! Form::open(['url'=>'/login', 'method'=>'post']) !!}

            <div class="w3-container w3-padding-16">
                {{Form::label('email','Email',['class'=>'w3-text-green'])}}
                {{Form::email('email',null,['class'=>'w3-input'])}}
            </div>

            <div class="w3-container w3-padding-16">
                {{Form::label('password','Password',['class'=>'w3-text-green'])}}
                {{Form::password('password',['class'=>'w3-input'])}}
            </div>

            <div class="w3-container w3-green w3-padding-16">
                <button type="submit" class="w3-button w3-pale-green w3-right" style="padding: 10px 50px">Login</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop
