@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          @foreach ($articlePolitica as $article)
              <div>
                Politica
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
          @foreach ($articleCronaca as $article)
              <div>
                Cronaca
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
          {{-- gli ultimi 3 articoli della categoria Politica --}}
          {{-- gli ultimi 3 articoli della categoria Cronaca --}}
          {{-- gli ultimi 3 articoli della categoria Scienze --}}
        </div>
      </div>
    </div>
@endsection