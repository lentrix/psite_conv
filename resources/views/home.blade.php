@extends('layouts.main')

@section('content')

<div class="w3-row-padding">

    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m4">
        <img src="{{asset('images/psite7_reg_con_2019_graphic_design.png')}}" width="100%" alt="graphic design">
    </div>
    <div class="w3-col m4">
        <h2>Summary</h2>
        <table class="w3-table w3-bordered w3-striped">
            <tr>
                <th>Total Registered</th><td>{{$meta['total']}}</td>
            </tr>
            <tr>
                <th>Confirmed/Active</th><td>{{$meta['active']}}</td>
            </tr>
            <tr>
                <th>Female</th><td>{{$meta['female']}}</td>
            </tr>
            <tr>
                <th>Male</th><td>{{$meta['male']}}</td>
            </tr>
        </table>
    </div>
</div>

@stop
