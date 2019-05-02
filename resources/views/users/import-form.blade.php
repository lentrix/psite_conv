@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m3">&nbsp;</div>
    <div class="w3-col m6">
        <h2>Import CSV File</h2>

        {!!Form::open(['url'=>'/user/import', 'files'=>'true'])!!}
            {{Form::label("csv_file","Select the csv file.",['class'=>'w3-text-green'])}}
            {{Form::file('csv_file', ['class'=>'w3-input'])}}
            {{Form::submit('Upload CSV File', ['class'=>'w3-button w3-green'])}}
        {!!Form::close()!!}
    </div>
</div>

@stop
