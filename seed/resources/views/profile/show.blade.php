@extends('layouts.app')
@section('content')
<style>
    .column {
        float: left;
        width: 33.33%;
    }

/* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    p{
        text-align: justify;
        text-justify: inter-word;
    }
    
</style>    
<a href="/home" style="float:right" class="btn btn-dark">Go Back</a> 
@can('is_admin', $user)
<a href="/profile" style="float:right" class="btn btn-dark">List of users</a>
@endcan
<h1>Profile</h1>
<div class="row">
    <div class="column" >
        <img style="width:350px;height:350px;margin:15px;" src="/storage/profile_pictures/{{Auth::user()->prof_pic}}" alt="">
        
    </div>
    <div class="column">
        <h2>{{Auth::user()->name}}</h2>
        <h5>{!!Auth::user()->job!!}</h5>
        <hr>
        <br><br><br><br><br><br><br>
        <p>T: {!!Auth::user()->tel!!}</p>
        <p>E: {!!Auth::user()->email!!}</p>
        <hr width="200%">
    </div>
    <div class="column">
        <h2>About Me</h2>
        <p>General info.</p>
        <hr>
        <p>{!!Auth::user()->bio!!}</p>
        
    </div>  
</div>
<div class= "row">
    <div class="column">
        <a href="/profile/{{Auth::user()->id}}/edit" style="margin-left:15px" class="btn btn-dark">Edit</a>
        <a href="/comments" style="margin-left:15px" class="btn btn-dark">Manage Comments</a>
        
    </div>
    <div class="column"></div>
    <div class="column">
        {!!Form::open(['action' => ['ProfileController@destroy', Auth::user()->id], 'method' => 'POST', 'class' =>'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger', 'style'=>'float:right'])}}
        {!!Form::close()!!}
    </div>
</div>
<br>

@endsection
