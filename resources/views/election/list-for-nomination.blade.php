@foreach(\App\User::where('active',1)->orderByRaw('lname, fname')->get() as $user)

<div class="w3-cell w3-third w3-padding-16 w3-container">
    <div class="w3-card-4">
        <img src="{{$user->getAvatarPath()}}" width="100%">
        <div class="w3-container" style="height: 120px;">
            <strong>{{$user->fullName()}}</strong> <br>
            {{$user->designation}}, {{$user->school}} <br><br>
        </div>
        <div class="w3-center">
            <form action="{{url('/election/nominate')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="nominee_user_id" value="{{$user->id}}" />
                <input type="hidden" name="nominator_user_id" value="{{auth()->user()->id}}">
                <button class="w3-button w3-green w3-block" type="submit">Nominate</button>
            </form>
        </div>
    </div>
</div>

@endforeach
