@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- tutti gli arguments in una tabella --}}
          {{-- questo utente può cancellare e modificare solo i suoi arguments --}}

          <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>User ID</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$argument->id}}</td>
                  <td>{{$argument->name}}</td>
                  <td>{{$argument->user_id}}</td>
                  
                  {{-- se il tuo user id è uguale allo user id della categoria --}}
                 
                  @if(Auth::id() == $argument->user_id)
                  <td><a class="btn btn-primary" href="{{route('admin.arguments.edit', $argument->id)}}">Modify</a></td>
                  <td>
                    <form action="{{route('admin.arguments.destroy', $argument->id)}}" method="post">
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
        </div>
      </div>
    </div>
@endsection