@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- form inserimento category --}}
          <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
            @method('POST')
            <label for="name">Nome</label>
            <input type="text" name="name" value="" placeholder="Inserisci il nome della categoria">
            <button type="submit">Salva</button>
          </form>
        </div>
      </div>
    </div>
@endsection