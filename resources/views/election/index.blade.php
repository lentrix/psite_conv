@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m8">
        @if(auth()->user()->admin)
            <a href="{{url('/election/admin')}}" class="w3-button w3-right w3-green">Election Admin</a>
        @endif

        <h2>PSITE-7 Officers' Election</h2>

        <?php
        $paths = [
            1=>['bar' => asset("images/stage_prep.png"), 'view' => 'election.prep'],
            2=>['bar' => asset("images/stage_nom.png"), 'view' => 'election.nom'],
            3=>['bar' => asset("images/stage_elect.png"), 'view' => 'election.elect'],
            4=>['bar' => asset("images/stage_results.png"), 'view' => 'election.results'],
        ];
        ?>

        <img src="{{$paths[$election->stage]['bar']}}" class="w3-hide-small" alt="stages">
        <h3 class="w3-hide-medium w3-hide-large">
            Stage: {{$election->stageString()}}
        </h3>

        @include($paths[$election->stage]['view'])

    </div>
</div>

@stop
