@extends('layouts.main')

@section('content')
<div class="w3-row w3-center">
    <h1>No Election created yet.</h1>
    <a href="{{url('/election/create')}}" class="w3-button w3-green">Create Election</a>
</div>
@stop
