@extends('layouts.app')
@section('content')

@can('create',App\Post::class)
    {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' =>'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'style'=>'float:right'])}}
    {!!Form::close()!!}
    <a href="/posts/{{$post->id}}/edit" style="float:right;" class="btn btn-dark">Edit</a>
@endcan
    <a href="/posts" style="float:right;" class="btn btn-dark">Go Back</a> 
<h1>{{$post->title}}</h1>
<br>
<div class="row">
    <div class="col-md-12" >
        <img style="width:400px;height:400px;margin-right:15px;float:left;" src="/storage/cover_images/{{$post->cover_image}}" alt="">
        <p class="text-just">{!!$post->body!!}</p>
    </div>
</div>
<hr>
<small>Written on {{$post->created_at}}</small>
<br>
<td><a href="{{action('PostController@downloadPDF', $post->id)}}">Download PDF</a></td>
<hr>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h3 class="comments-title"><svg class="bi bi-chat-square-dots" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2.5a2 2 0 0 1 1.6.8L8 14.333 9.9 11.8a2 2 0 0 1 1.6-.8H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
          </svg>  {{ $post->comments()->count() }} Comments</h3>
        @foreach($post->comments as $comment)
            <div class="comment">
                <div class="author-info">

                    <img src="/storage/profile_pictures/{{$comment->user->prof_pic}}" class="author-image">
                    <div class="author-name">
                        <h4>{{ $comment->user->name }}</h4>
                        <p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
                    </div>
                    
                </div>

                <div class="comment-content">
                    {!!$comment->comment!!}
                </div>
                
                <div>
                    @can('edit-delete-comment', $comment)
                        <a href="{{ route('comments.edit', $comment->id) }}" style="float:right;" class="btn btn-xs btn-primary"></span>Edit</a>
                        {!!Form::open(['action' => ['CommentController@destroy', $comment->id], 'method' => 'POST', 'class' =>'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-xs btn-danger', 'style'=>'float:right'])}}
                        {!!Form::close()!!}
                    @else
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
</div>

<hr>   
@if(Auth::check())
<div class="row">
    <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-left: 200px;">
        {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
        
                <div class="col-md-12">
                    {{ Form::label('comment', "Comment:") }}
                    {{ Form::textarea('comment', null, ['id' => 'article-ckeditor','class' => 'form-control', 'rows' => '5']) }}

                    {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;margin-bottom:15px']) }}
                </div>
            </div>

        {{ Form::close() }}
    </div>
</div>
@else
<p>Login or Register to Comment!</p>
@endif

@endsection