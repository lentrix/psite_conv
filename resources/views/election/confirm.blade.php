@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m8">
        <h1>Votes Confirmation</h1>
        <h3>You are about to vote for the following candidates:</h3>

        @if(count($candidates)>0)
            <form action="{{url('/election/vote')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="voter_user_id" value="{{$voter_id}}">

                @foreach($candidates as $candidate)
                    <input type="hidden" name="candidate_ids[]" value="{{$candidate->id}}">
                    <div class="w3-cell w3-third w3-container" style="margin-bottom: 20px">
                        <img src="{{$candidate->getAvatarPath()}}" width="100%">
                        <div class="w3-card-2 w3-padding-16 w3-container">
                            <span style="font-size: 1.1em; font-weight: bold">{{$candidate->fullName()}}</span> <br>
                            <span>{{$candidate->designation}}, {{$candidate->school}}</span>
                        </div>
                    </div>
                @endforeach

                <div class="w3-row w3-center" style="margin-top: 20px;">
                    <br>
                    <button type="submit" class="w3-button w3-green w3-hover-yellow"><h3>Confirm &amp; Submit</h3></button>
                    <a href="{{url('/election')}}" class="w3-button w3-red w3-hover-yellow"><h3>Cancel go Back</h3></a>

                </div>
            </form>
        @endif
    </div>
</div>

@stop
