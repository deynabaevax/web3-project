<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>{{$post->title}}</h1>
    <div class="row">
    <!--<div class="col-md-12">
        <img style="width:250px" src="C:/xampp/htdocs/lsapp/seed/public/storage/cover_images/{{$post->cover_image}}" alt="">
    </div>-->
    </div>
    <p>{!!$post->body!!}</p>
<hr>
<small>Written on {{$post->created_at}}</small>
  </body>
</html>