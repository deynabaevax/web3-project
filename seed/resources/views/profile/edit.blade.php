@extends('layouts.app')
@section('content')
    <h1>Update User</h1>
    {!! Form::open(['action' => ['ProfileController@update',$user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('job', 'Job')}}
            {{Form::text('job', $user->job, ['class' => 'form-control', 'placeholder' => 'Job'])}}
        </div>
        <div class="form-group">
            {{Form::label('tel', 'Tel')}}
            {{Form::text('tel', $user->tel, ['class' => 'form-control', 'placeholder' => 'Tel'])}}
        </div>
        <div class="form-group">
            {{Form::label('bio', 'Bio')}}
            {{Form::textarea('bio', $user->bio, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Bio Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('prof_pic')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection