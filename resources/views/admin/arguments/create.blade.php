@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- form inserimento argument --}}
          <form action="{{route('admin.arguments.store')}}" method="POST">
            @csrf
            @method('POST')
            <label for="name">Nome</label>
          <input type="text" name="name" value="{{old('name')}}" placeholder="Inserisci il nome dell'argomernto">
            <button type="submit">Salva</button>
          </form>
        </div>
      </div>
    </div>
@endsection