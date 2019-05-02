<h3>List of Nominees</h3>

@foreach(\App\Nomination::list() as $nominee)

<div class="w3-card-2 {{$nominee->candidate?'w3-pale-green':''}}" style="margin-bottom: 16px">
    <div class="w3-row relative">
        <div class="w3-col s4">
            <img src='{{$nominee->getAvatarPath()}}' width="100%" />
        </div>
        <div class="w3-col s8 w3-padding-16 w3-container">
            <strong>{{$nominee->fullName()}}</strong> <br>
            {{$nominee->designation}}, <br>
            {{$nominee->school}}
            @if($nominee->candidate)
                <br><span class="w3-text-green"><strong>[Candidate]</strong></span>
            @endif

            <div class="t-right w3-text-green">
                <span class="w3-badge w3-green">
                    {{$nominee->nominationCount()}}
                </span> Nominations
            </div>

            @if(!$nominee->candidate)
            <form action="{{url('/election/set-candidate')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="candidate_user_id" value="{{$nominee->id}}">
                <input type="hidden" name="is_candidate" value="1">
                <button class="w3-button w3-green b-right">Accept as candidate</button>
            </form>
            @else
            <form action="{{url('/election/set-candidate')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="candidate_user_id" value="{{$nominee->id}}">
                <input type="hidden" name="is_candidate" value="0">
                <button class="w3-button w3-pale-red b-right">Revoke candidacy</button>
            </form>
            @endif
        </div>
    </div>
</div>

@endforeach
