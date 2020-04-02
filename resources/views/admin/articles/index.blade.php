@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- tutti le articoli in una tabella --}}
          <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>User name</th>
                  <th>Title</th>
                  <th>Summary</th>
                  <th>Category</th>
                  <th>Arguments</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $article)
                <tr>
                  <td>{{$article->id}}</td>
                  <td>{{$article->user->name}}</td>
                  <td>{{$article->title}}</td>
                  <td>{{$article->summary}}</td>
                  <td>{{$article->category->name}}</td>
                  <td>
                    <ul class="">
                    @forelse  ($article->arguments as $argument)
                      <li>{{$argument->name}}</li>
                    @empty
                      <li>No arguments</li>
                    @endforelse
                    </ul>
                  </td>
                  <td><a class="btn btn-primary" href="{{route('admin.articles.show', $article)}}">View</a></td>
                  {{-- se il tuo user id è uguale allo user id della categoria --}}
                 
                  @if(Auth::id() == $article->user_id)
                <td><a class="btn btn-primary" href="{{route('admin.articles.edit', $article)}}">Modify</a></td>
                  <td>
                    <form action="{{route('admin.articles.destroy', $article)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                  </td>
                  @else
                  <td></td>
                  <td></td>
                  @endif
                  
                </tr>
                @endforeach
              </tbody>
          </table>
          {{-- questo utente può cancellare e modificare solo le sue articoli --}}
        </div>
      </div>
    </div>
@endsection