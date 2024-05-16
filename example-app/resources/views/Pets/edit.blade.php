@extends('dashboard')

@section('title', 'Dodajemy nowego zwiuerza')

@section ('form')
<div class="container">
  <div class="card" style= "margin-top: 20px">
    <div class="card-header">
      Edycja pupila: {{$pet->name}}
    </div>
    <div class="card-body">
      <form action="/pet/edit/{{$pet->id}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Kategoria:</label>
              <select class="form-control" name="category"  required>
                  <option value="">--Wybierz jedną z opcji--</option>
                  @foreach($categories as $category)
                      <option value="{{$category['value']}}" @if ($category['name'] == $pet->category ? '' : $pet->category->name) selected="selected" @endif>{{$category['name']}}</option>
                  @endforeach
              </select>


            <label for="name">Nazwa:</label>
            <input type="text" class="form-control" name="name" value="{{$pet->name}}" required>

            <label for="name">Tagi:</label>
            <!-- ToDo zamienić na selecta z wielokrotnym wyborem -->
            <select class="form-control" name="tags"  required>
                <option value="">--Wybierz tagi--</option>
                @foreach($tags as $tag)
                    <option value="{{$tag['value']}}" @if ($tag['name'] == $pet->tags[0] ? '' : $pet->tags[0]->name) selected="selected" @endif>{{$tag['name']}}</option>
                @endforeach
            </select>

          <label for="name">Status:</label>
          <select class="form-control" name="status"  required>
              <option value="">--Wybierz jedną z opcji--</option>
              @foreach($statuses as $status)
                  <option value="{{$status['value']}}" @if ($status['name'] == $pet->status ? '' : $pet->status) selected="selected" @endif>{{$status['name']}}</option>
              @endforeach
          </select>

          </div>

          <input type="submit" class="btn btn-success" value="Zapisz zmiany">
          <input type="button" class="btn btn-primary" onclick="location.href='/'" value="Anuluj">
      </form>
    </div>
  </div>
</div>
@endsection('form')