<img src="{{asset('images/brand-logo.png')}}" id="brand-logo" alt="PSITE-7">

<div class="w3-bar w3-green main-nav">
    <div class="w3-bar-item brand">Regional Convention 2019</div>
    <div class="w3-right w3-bar-item menu w3-mobile">
        <a href="{{url('/')}}" class="w3-button w3-hover-pale-green">Home</a>
        <a href="{{url('/program')}}" class="w3-button w3-hover-pale-green">Program</a>

        @auth
            @if(auth()->user()->admin)
                <a href="{{url('/delegates')}}" class="w3-button w3-hover-yellow">Delegates</a>
            @endif
            <a href="{{url('/election')}}" class="w3-button w3-hover-yellow">Election</a>
            <a href="{{url('/raffle')}}" class="w3-button w3-hover-yellow">Raffle Draw</a>
            <a href="#" class="w3-button w3-hover-blue w3-teal user-label">
                {{auth()->user()->fname}}
            </a>
        @else
            <a href="{{url('/login')}}" class="w3-button w3-hover-pale-green">Login</a>
        @endauth
    </div>
</div>

@auth
<div class="w3-card w3-card-4 w3-teal" id="user-info">
    <img src="{{asset(auth()->user()->getAvatarPath())}}" alt="pic" width="300">
    <div class="w3-container w3-center">
        <p>{{auth()->user()->lname . ', ' . auth()->user()->fname}}</p>
    </div>
    <ul class="w3-ul w3-hoverable w3-border">
        <li>
            <a href="{{url('/profile/' . auth()->user()->id)}}" class="w3-button w3-block">Profile</a>
        </li>
        <li>
            <a href="{{url('/logout')}}" class="w3-button w3-block">Logout</a>
        </li>
    </ul>
</div>

<script>
$(document).ready(function(){
    $('.user-label').click(function(evt){
        $('#user-info').toggle(200);
        evt.stopPropagation();
    })
    $(document).click(function(){
        if($("#user-info").css('display')=='block')
            $('#user-info').hide(200);
    })
})
</script>
@endauth
