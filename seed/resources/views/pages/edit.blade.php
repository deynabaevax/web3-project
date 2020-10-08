@extends('layouts.app')
@section('content')
    <h1>Update Comment</h1>
    {!! Form::open(['action' => ['CommentController@update',$comment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('comment', 'Comment')}}
            {{Form::textarea('comment', $comment->comment, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Comment Text'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-dark', 'style' => 'margin-bottom:15px'])}}
    {!! Form::close() !!}
@endsection