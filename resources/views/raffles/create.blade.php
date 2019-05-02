@extends('layouts.main')

@section('content')

<div class="w3-row-padding">

    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m4 w3-animate-left">
        <div class="w3-card-4">
            <header class="w3-container w3-green">
                <h3>Register Prize</h3>
            </header>
            {!!Form::open(['url'=>'/raffle/prize', 'method'=>'post']) !!}

            <p class="w3-container">
                {{Form::label('prize','Prize', ['class'=>'w3-text-green'])}}
                {{Form::text('prize',null,['class'=>'w3-input'])}}
            </p>

            <p class="w3-container">
                {{Form::label('sponsor','Sponsor', ['class'=>'w3-text-green'])}}
                {{Form::text('sponsor',null,['class'=>'w3-input'])}}
            </p>

            <p class="w3-container">
                    {{Form::label('number','Number of Items', ['class'=>'w3-text-green'])}}
                    {{Form::number('number',null,['class'=>'w3-input'])}}
                </p>

            <div class="w3-padding-16 w3-green w3-container">
                <button type="submit" class="w3-button w3-pale-green w3-right">Create Prize</button>
            </div>

            {!!Form::close()!!}
        </div>
    </div>
    <div class="w3-col m4 w3-animate-right">
        <h3>List of Prizes</h3>
        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th>Prize</th>
                    <th>Sponsor</th>
                    <th>Drawn</th>
                </tr>
            </thead>
            <tbody>
                @foreach($raffles as $raffle)
                <tr>
                    <td>{{$raffle->prize}}</td>
                    <td>{{$raffle->sponsor}}</td>
                    <td>
                        {{$raffle->drawn_on?$raffle->drawn_on->diffForHumans():'not drawn yet'}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
