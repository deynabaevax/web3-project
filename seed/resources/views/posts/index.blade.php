@extends('layouts.app')

@section('content')
@can('create', App\Post::class)
<a href="/posts/create" style="float:right;" class="btn btn-dark">Create post</a>
@endcan
<h1>Posts</h1>
@if(count($posts)>0)           
            <div class="row row-cols-1 row-cols-md-2">
                @foreach($posts as $post)
                    
                        <div class="col mb-4">
                        <div class="card">
                            <div class="card-body">
                            <img style="width:250px" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">Written on {{$post->created_at}} </p>
                            <a href="/posts/{{$post->id}}" class="btn btn-dark">See more</a> 
                            </div>
                        </div>
                        </div>
                @endforeach               
            </div>
        {{$posts->links()}}
@else
<p>No Posts Found</p>
@endif
@endsection
