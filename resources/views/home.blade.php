@extends('layouts.main')

@section('content')

<div class="w3-row-padding">

    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m4">
        <img src="{{asset('images/psite7_reg_con_2019_graphic_design.png')}}" width="100%" alt="graphic design">
    </div>
    <div class="w3-col m4">
        <h3>Total Registered: {{$meta['total']}}</h3>
        <h3>Confirmed/Active: {{$meta['active']}}</h3>
    </div>
</div>

@stop
