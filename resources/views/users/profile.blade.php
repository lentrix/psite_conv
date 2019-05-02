@extends('layouts.main')

@section('content')

    <div class="w3-row-padding w3-padding">
        <div class="w3-col m2">&nbsp;</div>
        <div class="w3-col m3 w3-animate-left">
            <div class="w3-card-4">

                <img src="{{asset($user->getAvatarPath())}}" alt="No Picture" class="avatar">

                <div class="w3-container w3-center">
                    <p>
                        <strong>ID # {{$user->id}}</strong><br>
                        {{$user->fullName()}} <br>
                        {{$user->designation}}, {{$user->school}}
                    </p>
                </div>
            </div>

        </div>

        <div class="w3-col m5">
            <div class="w3-card-4 w3-animate-right">
                <header class="w3-container w3-teal">
                    <h3>Delegate Profile <span class="w3-text-red">{{($user->active?'':'[Inactive]')}}</span></h3>
                </header>
                <div class="w3-container w3-padding-24">
                    <table class="w3-table w3-bordered">
                        <tr>
                            <th>Last Name</th>
                            <td>{{$user->lname}}</td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td>{{$user->fname}}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{strcmp($user->gender,"F")===0?"Female":"Male"}}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{$user->designation}}</td>
                        </tr>
                        <tr>
                            <th>School</th>
                            <td>{{$user->school}}</td>
                        </tr>
                        <tr>
                            <th>School Address</th>
                            <td>{{$user->school_address}}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{$user->email}}</td>
                        </tr>
                    </table>
                    <p>
                    @if(auth()->user()->admin)
                    <form action="{{url('/user/set-active')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="active" value="{{ ($user->active?0:1)}}">
                        <button class="w3-button w3-{{($user->active?'orange':'green')}} w3-left">
                            {{($user->active?"Deactivate":"Activate") }}
                        </button>
                    </form>
                    @endif

                        <a href='{{url("/user/$user->id")}}' class="w3-button w3-teal w3-right">Edit User</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(".avatar").click(function(){
                document.location='{{url("/user/$user->id/pic")}}';
            })
        })
    </script>
@stop
