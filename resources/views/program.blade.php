@extends('layouts.main')

@section('content')

<div class="w3-container w3-row-padding w3-animate-bottom">
    <div class="w3-col m1">&nbsp;</div>
    <div class="w3-col m10">
        <embed src="{{asset('program.pdf')}}" type="application/pdf" width="100%" height="570px" />
    </div>
</div>
@stop
