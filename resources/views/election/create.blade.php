@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m4">&nbsp;</div>
    <div class="w3-col m4">
        <div class="w3-card-4">
            <header class="w3-container w3-green">
                <h3>Create Election</h3>
            </header>
            {!!Form::open(['method'=>'post', 'url'=>url("/election/create")])!!}

            {{Form::hidden('created_by', auth()->user()->id)}}
            <div class="w3-container">
                <p>
                    {{Form::label('title','Title',['class'=>'w3-text-green'])}}
                    {{Form::text('title',null,['class'=>'w3-input'])}}
                </p>
                <p>
                    {{Form::label('max_votes','Max Votes',['class'=>'w3-text-green'])}}
                    {{Form::number('max_votes',null,['class'=>'w3-input'])}}
                </p>
            </div>

            <div class="w3-container w3-padding-16 w3-green">
                <button type="submit" class="w3-button w3-pale-green w3-right">
                    Create Election
                </button>
            </div>

            {!!Form::close()!!}
        </div>
    </div>
</div>

@stop
