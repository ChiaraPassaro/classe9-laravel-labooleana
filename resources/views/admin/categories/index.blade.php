@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- tutti le categorie in una tabella --}}
          {{-- @dd($categories) --}}
          <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>User ID</th>
                  <th colspan="3"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->user_id}}</td>
                <td><a class="btn btn-primary" href="{{route('admin.categories.show', $category)}}">View</a></td>
                  {{-- se il tuo user id è uguale allo user id della categoria --}}
                 
                  @if(Auth::id() == $category->user_id)
                  <td><a class="btn btn-primary" href="">Modify</a></td>
                  <td>
                    @if($category->id != 1)
                    <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                    @endif
                  </td>
                  @else
                  <td></td>
                  <td></td>
                  @endif
                  
                </tr>
                @endforeach
              </tbody>
          </table>
          {{-- questo utente può cancellare e modificare solo le sue categorie --}}
        </div>
      </div>
    </div>
@endsection