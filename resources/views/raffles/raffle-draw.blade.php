@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m8">
        <h3>For the prize: {{$raffle->prize}} from {{$raffle->sponsor}}</h3>
        <form action="{{url('/raffle/confirm')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="raffle_id" value="{{$raffle->id}}" />
            <input type="hidden" name="user_id" id="user-id" />
            <div id="result-window" class="w3-panel w3-pale-green w3-container w3-text-center w3-padding-48 w3-center">
                <h1 id="full-name"></h1>
                <p id="school"></p>
            </div>
            <button id="start" type="button">Start</button>
            <button type="submit">Confirm</button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function(){
        let data = [
            @foreach($users as $user)
                <?= "{id:\"$user->id\", name:\"$user->lname, $user->fname\", school:\"$user->school\"},\n"; ?>
            @endforeach
        ];

        $("#start").click(function(){
            $("#result-window").removeClass('confetti');
            var spinner = setInterval(function(){
                obj = data[Math.floor(Math.random()*data.length)];
                $('#full-name').text(obj.name);
                $('#school').text(obj.school);
            },100);

            setTimeout(function(){
                clearInterval(spinner);
                $("#message").text("Congratulations to");
                $('#result-window').addClass('confetti');
                $('#buttons').css('display','inline-block');
                $('#user-id').attr('value', obj.id);
            }, 3000);

            console.log(data);
        })
    })

</script>

@stop
