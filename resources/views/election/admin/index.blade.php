@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m6 w3-animate-left">
        <h2>Election Admin</h2>
        <hr>
        <h3>Current Stage: {{$election->stageString()}}</h3>

        @if($election->stage==2)
            @include('election.admin.nom')
        @endif

        @if($election->stage==3)
            @include('election.admin.elect')
        @endif

    </div>
    <div class="w3-col m2 w3-animate-right">
        @foreach($labels as $index=>$label)
        <p>
            @if($index-1==$election->stage)
                <a href='{{url("/election/admin/$index")}}'
                        class="w3-button w3-green w3-hover-yellow w3-block">
                    {{$label}}
                </a>
            @else
                <span class="w3-button w3-hover-light-gray w3-light-gray w3-block">{{$label}}</span>
            @endif
        </p>
        @endforeach
    </div>
</div>

@stop
