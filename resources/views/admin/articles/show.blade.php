@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          @isset($article->path_image)
            <img src="{{asset('storage/' . $article->path_image)}}" alt="">
          @endisset
          <h2>{{$article->title}}</h2>
          <h3>di: {{$article->user->name}}</h3>
          <div>
            {{$article->summary}}
          </div>
          <div>
            {{$article->body}}
          </div>
        </div>
      </div>
    </div>
@endsection