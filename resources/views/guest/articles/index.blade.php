@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          @foreach ($articles as $article)
              <div>
               <h2>{{$article->title}}</h2> 
               <p>{{$article->summary}}</p>
               <small>{{$article->user->name}}</small>
               <p>
                  Argomenti: 
                  @forelse ($article->arguments as $argument)
                   {{$argument->name}} 
                  @empty
                      
                  @endforelse
               </p>
               
              </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection