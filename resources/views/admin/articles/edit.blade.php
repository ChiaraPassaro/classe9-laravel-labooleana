@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{-- form modifica articolo --}}
           <form action="{{route('admin.articles.update', $article)}}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PATCH')

            <div class="form-group">
              <select name="category_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}" {{($article->category_id == $category->id) ? 'checked' : ''}}>{{$category->name}}</option>
                @endforeach
              </select>
            </div>
           
            <div class="form-group">
              <label for="title">Titolo</label>
            <input type="text" name="title" value="{{$article->title}} {{old('title')}}">
            </div>

            <div class="form-group">
              <label for="title">Sommario</label>
              <input type="text" name="summary" value="{{$article->summary}} {{old('summary')}}">
            </div>

            <div class="form-group">
              <label for="title">Testo</label>
              <textarea name="body"cols="30" rows="10">{{$article->body}} {{old('body')}}</textarea>
            </div>

            <div class="form-group">
              <label for="published">Pubblicato</label>
              <select name="published">
                <option value="0" {{($article->published == 0) ? 'checked' : ''}}>Non pubblicato</option>
                <option value="1" {{($article->published == 1) ? 'checked' : ''}}>Pubblicato</option>
              </select>
            </div>

            <div class="form-group">
              @isset($article->path_image)
                <img src="{{asset('storage/' . $article->path_image)}}" alt="">
              @endisset
              <input type="file" name="path_image" accept="image/*">
            </div>

            <div class="form-group">
              <label for="arguments">Argomenti</label>
              @foreach ($arguments as $argument)
                <span>{{$argument->name}}</span>
                <input type="checkbox" name="arguments[]" value="{{$argument->id}}" {{($article->arguments->contains($argument->id)) ? 'checked' : ''}}>  
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