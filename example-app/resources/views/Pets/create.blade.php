@extends('dashboard')

@section('title', 'Dodajemy nowego zwierza')

@section ('form')
<div class="container">
  <div class="card" style= "margin-top: 20px">
    <div class="card-header">
      Dodawanie pupila
    </div>
    <div class="card-body">
      <form action="/pet/create" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Kategoria:</label>
            <select class="form-control" name="category"  required>
                <option value="">--Wybierz jedną z opcji--</option>
                @foreach($categories as $category)
                    <option value="{{$category['value']}}">{{$category['name']}}</option>
                @endforeach
            </select>


            <label for="name">Nazwa:</label>
            <input type="text" class="form-control" name="name" required>

            <label for="name">Tagi:</label>
            <!-- ToDo zamienić na selecta z wielokrotnym wyborem -->
            <select class="form-control" name="tags"  required>
                <option value="">--Wybierz tagi--</option>
                <option value="gourmand">Łasuch</option>
                <option value="hairy">Sierściuch</option>
            </select>

            <label for="name">Status:</label>
            <select class="form-control" name="status"  required>
                <option value="">--Wybierz jedną z opcji--</option>
                @foreach($statuses as $status)
                    <option value="{{$status['value']}}">{{$status['name']}}</option>
                @endforeach
            </select>

          </div>

          <input type="submit" class="btn btn-primary" value="Dodaj">
      </form>
    </div>
  </div>
</div>
@endsection('form')