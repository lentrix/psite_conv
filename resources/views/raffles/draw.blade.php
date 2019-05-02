@extends('layouts.main')

@section('content')


<div class="w3-row-padding">
    <div class="w3-col m3">&nbsp;</div>
    <div class="w3-col m6">
        {!!Form::open(['url'=>'/raffle/draw', 'method'=>'post'])!!}
        <div class="w3-padding-16">
            {{Form::label('prize')}}
            {{Form::select('prize', $listPrizes,null,['placeholder'=>'Select a prize', 'class'=>'w3-input'])}}
        </div>
        <div class="w3-padding-16">
            {{Form::checkBox('filter',null,['id'=>'filter'])}}
            {{Form::label('filter','Exclude previous winners')}}
        </div>
        <div class="w3-padding-16">
            <button type="submit" class="w3-button w3-block w3-green">
                Draw A Winner!
            </button>
        </div>
        {!!Form::close()!!}
    </div>
</div>

@stop
