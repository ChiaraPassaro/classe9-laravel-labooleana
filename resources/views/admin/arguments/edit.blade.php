@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- form modifica argument --}}
          <form action="{{route('admin.arguments.update', $argument)}}" method="POST">
            @csrf
            @method('PATCH')
            <label for="name">Nome</label>
            <input type="text" name="name" value="{{old('name')}} {{$argument->name}}" placeholder="Inserisci il nome dell'argomernto">
            <button class="btn btn-primary" type="submit">Salva</button>
          </form>
        </div>
      </div>
    </div>
@endsection