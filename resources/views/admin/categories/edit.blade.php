@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- form modifica category --}}
        <form action="{{route('admin.categories.update', $category)}}" method="POST">
            @csrf
            @method('PATCH')
            <label for="name">Nome</label>
            <input type="text" name="name" value="{{$category->name}}">
            <button type="submit">Salva</button>
          </form>
        </div>
      </div>
    </div>
@endsection