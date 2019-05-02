
        <p>
            The election process is in the nomination stage.
            @if($nomination = auth()->user()->nomination)
                You have nominated {{$nomination->theNominee->fullName()}}. You can no longer
                make a nomination.</p>
                <h3>Your nomination</h3>
                <div class="w3-col m4">
                    <div class="w3-card-4">
                        <img src="{{$nomination->theNominee->getAvatarPath()}}" width="100%">
                        <div class="w3-container w3-center">
                            <strong>{{$nomination->theNominee->fullName()}}</strong> <br>
                            {{$nomination->theNominee->designation}}, {{$nomination->theNominee->school}} <br><br>
                        </div>
                    </div>
                </div>
            @else
                You may select any member here for your nomination.</p>
                @include('election.list-for-nomination')
            @endif
        </p>
