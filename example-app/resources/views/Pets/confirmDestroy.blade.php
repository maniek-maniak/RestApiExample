@extends('dashboard')

@section('title', 'Dodajemy nowego zwiuerza')

@section ('form')
<div class="container">
  <div class="card" style= "margin-top: 20px">
    <div class="card-header">
      Usuwanie pupila: {{$pet->name}}
    </div>
    <div class="card-body">
      <form action="/pet/delete/confirm/{{$pet->id}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Kategoria:</label>
              <input type="text" class="form-control" value="{{$pet->category->name ?? 'Drak danych!'}}" readonly>


            <label for="name">Nazwa:</label>
              <input type="text" class="form-control" value="{{$pet->name}}" readonly>
          </div>

          <label for="name">Czy aby naperwo?</label>
          <input type="submit" class="btn btn-danger" value="Usuń">
          <input type="button" class="btn btn-primary" onclick="location.href='/'" value="Anuluj">
      </form>
    </div>
  </div>
</div>
@endsection('form')