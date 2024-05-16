@extends('dashboard')

@section('title', 'Page Title')

@section('table')
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">Kategoria</th>
        <th scope="col">Nazwa</th>
        <th scope="col">Linki do zdjęć</th>
        <th scope="col">Tagi</th>
        <th scope="col">Akcje</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pets as $pet)
          <tr>
            <th scope="row">
                {{$pet->id}}
            </th>
            <td>
              @if (isset($pet->category))
                {{ $pet->category->name}}
              @endif
            </td>
            <td>{{$pet->name}}</td>
            <td>
                @if (isset($pet->photoUrls))
                  @foreach ($pet->photoUrls as $url)
                    {{$url}}
                  @endforeach
                @endif
            </td>
            <td>
              @foreach ($pet->tags as $tag)
                @if (isset($tag->name))
                  {{$tag->name}}
                @endif
              @endforeach
            </td>
            <td>
              <ul class="navbar-nav">
                  <li class="nav-item active"><a class="nav-link" href="pet/show/{{$pet->id}}">Edytuj</a></li>
                  <li class="nav-item active"><a class="nav-link" href="pet/delete/ask/{{$pet->id}}">Usuń</a></li>
              </ul>
          </td>
          </tr>
      @endforeach
    </tbody>
  </table>
@endsection