@extends('layouts.main')

@section('content')

<div class="w3-row-padding">
    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m6">
        <h3>Take a Picture</h3>
    </div>
</div>

<div class="w3-row-padding">
    <div class="w3-row-padding">
        <div class="w3-col m2">&nbsp;</div>
        <div class="w3-col m4">
            <video width="400" height="300" id="video"></video><br>
            <button type="button" id="snap" class="w3-button w3-green">Take</button>
        </div>
        <div class="w3-col m4">
            <canvas width="400" height="300" id="canvas"></canvas> <br>
            <form method="post" action='{{url("/user/$user->id/avatar")}}'>
                {{csrf_field()}}
                <input type="hidden" name="image-data" id="image-data" />
                <input type="hidden" name="user_id" value="{{$user->id}}" />
                <button type="submit" class="w3-button w3-green">Set as avatar</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Grab elements, create settings, etc.
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var file_input = $("#file_input");

        // Get access to the camera!
        if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Not adding `{ audio: true }` since we only want video now
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                //video.src = window.URL.createObjectURL(stream);
                video.srcObject = stream;
                video.play();
            });
        }

        $("#snap").click(function() {
            context.drawImage(video, 0, 0, 400, 300);
            $("#image-data").val(canvas.toDataURL());
        })
    })
</script>

@stop
