@extends('layouts.app')
@section('content')
<style>
p {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 75ch;;
}
</style>
<div class="row row-cols-1 row-cols-md-2">
  @foreach($posts ?? '' as $post)  
  <div class="col mb-4">
      <div class="card">
        <img src="/storage/cover_images/{{$post->cover_image}}" height="550" class="card-img-top" alt="">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{!!$post->body!!}</p>
          <a href="/posts/{{$post->id}}" class="btn btn-dark">Read more</a> 
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection