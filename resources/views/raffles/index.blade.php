@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m1">&nbsp;</div>
    <div class="w3-col m7 w3-animate-left">
        <h3>Raffle Draw Winners</h3>
        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Winner</th>
                    <th>Prize/Sponsor</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($winners as $index=>$winner)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>
                        {{$winner->winner->fullName()}} <br>
                        <span style="font-size: 0.75em">{{$winner->winner->school}}</span>
                    </td>
                    <td>
                        {{$winner->prize}} <br>
                        <span style="font-size: 0.75em">from {{$winner->sponsor}}</span>
                    </td>
                    <td>
                        {{$winner->drawn_on->diffForHumans()}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(auth()->user()->admin)
    <div class="w3-col m3 w3-animate-right">
        <p>
            <a href="{{url('/raffle/draw')}}" class="w3-button w3-green w3-block">
                Draw a Winner
            </a>
        </p>
        <p>
            <a href="{{url('/raffle/prize')}}" class="w3-button w3-green w3-block">
                Prizes
            </a>
        </p>
    </div>
    @endif
</div>

@stop
