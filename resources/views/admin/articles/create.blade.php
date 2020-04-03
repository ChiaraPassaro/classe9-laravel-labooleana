@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- form inserimento articolo --}}
          <form action="{{route('admin.articles.store')}}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('POST')

            <div class="form-group">
              <select name="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
           
            <div class="form-group">
              <label for="title">Titolo</label>
              <input type="text" name="title">
            </div>

            <div class="form-group">
              <label for="title">Sommario</label>
              <input type="text" name="summary">
            </div>

            <div class="form-group">
              <label for="title">Testo</label>
              <textarea name="body"cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
              <label for="published">Pubblicato</label>
              <select name="published">
                <option value="0">Non pubblicato</option>
                <option value="1">Pubblicato</option>
              </select>
            </div>

            <div class="form-group">
              <input type="file" name="path_image" accept="image/*">
            </div>

            <div class="form-group">
              <label for="arguments">Argomenti</label>
              @foreach ($arguments as $argument)
                <span>{{$argument->name}}</span>
                <input type="checkbox" name="arguments[]" value="{{$argument->id}}">  
              @endforeach
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success">Salva</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection