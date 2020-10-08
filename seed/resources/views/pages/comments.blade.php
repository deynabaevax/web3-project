@extends('layouts.app')

@section('content')

<h1>Your Comments</h1>
@if(count($user->comments)>0)           
    <table class="table">
        <thead>
            <tr>
                <th>Post</th>
                <th>Comment</th>
                <th width="70px"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($user->comments as $comment)
            <tr>
                <td>{{ $comment->post->title }}</td>
                <td>{!!$comment->comment!!}</td>
                <td>
                    <a href="{{ route('posts.show', $comment->post->id) }}" class="btn btn-xs btn-primary">More</a>
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-danger">Edit</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
<p>No Posts Found</p>
@endif
@endsection