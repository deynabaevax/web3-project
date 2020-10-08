@extends('layouts.app')
@section('content')

<h2>Search results</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($postsSearched as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{!!$post->body!!}</td>
            <td>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-dark">See more</a>
            </td>
            <td style="display-flex">
            </td></tr>
            
        @endforeach
    </tbody>
</table>
@endsection