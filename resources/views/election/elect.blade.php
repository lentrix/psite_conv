<p>
    The election is now on-going.
</p>

@if(!auth()->user()->voted_on)
    <p>
        You may select a maximum of <span class="w3-badge w3-green">{{$election->max_votes}}</span>
        among the following candidates.
    </p>

<form action="{{url('/election/vote-confirm')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="voter_user_id" value="{{auth()->user()->id}}">
    @foreach(\App\User::candidates() as $candidate)

        <div class="w3-card-2" style="position: relative">
            <div class="w3-row" style="margin-bottom: 16px" id="container_{{$candidate->id}}">
                <div class="w3-col m3">
                    <img src="{{$candidate->getAvatarPath()}}" width="100%">
                </div>
                <div class="w3-col m7">
                    <div class="w3-container w3-padding-16">
                        Ref #{{$candidate->id}} <br>
                        <strong>{{$candidate->fullName()}}</strong><br>
                        {{$candidate->designation}}, {{$candidate->school}}
                    </div>
                    <i class="check" id="{{$candidate->id}}"></i>
                    <input type="checkbox"
                                class="input"
                                style="display: none"
                                name="votes[]"
                                id="input_{{$candidate->id}}"
                                value="{{$candidate->id}}">
                </div>
            </div>
        </div>
    @endforeach
    <button class="w3-button w3-green w3-block w3-hover-red"><h3>Cast Vote</h3></button>
</form>

<div id="exceed-alert" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content">
        <div class="w3-container w3-red">
            <span onclick="document.getElementById('exceed-alert').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <p class="w3-container w3-padding-16">
                You have reached the limit of {{$election->max_votes}} votes!
            </p>
        </div>
    </div>
</div>

@else

    <h2>
        You have casted <span class="w3-badge">{{count(auth()->user()->votesMade)}}</span> votes
        {{auth()->user()->voted_on->diffForHumans()}}
    </h2>
    <p>Thank you very much!</p>

@endif


<script>
$(document).ready(function(){
    var limit = {{$election->max_votes}};
    $(".input").prop('checked', false);

    $(".check").click(function(){
       var id = $(this).attr('id');
       var inp = $("#input_" + id);

       if(!inp.prop('checked')) {
            if(limit>0) {
                inp.prop('checked', true);
                $(this).addClass('checked');
                $("#container_" + id).addClass('w3-pale-green');
                limit--;
            }else {
                $("#exceed-alert").css('display','block');
            }
       }else {
           inp.prop('checked', false);
           $(this).removeClass('checked');
           $("#container_" + id).removeClass('w3-pale-green');
           limit++;
           if(limit>3) limit = 3;
       }
    })
})
</script>
