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
                  <th>User name</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->user->name}}</td>
                  @if(Auth::id() == $category->user_id)
                <td><a class="btn btn-primary" href="{{route('admin.categories.edit', $category)}}">Modify</a></td>
                  <td>
                    <form action="" method="post">
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
              </tbody>
          </table>
          {{-- questo utente può cancellare e modificare solo le sue categorie --}}
        </div>
      </div>
    </div>
@endsection