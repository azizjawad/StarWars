@extends('Layout/app')

@section('content')
<div class="col-md-6">
  <h3>Name - {{$people->name}}</h3>
    <hr><br>
    @if (count($films) > 0)
    <ul class="list-group">
        <h4>Films</h4>
        @foreach($films as $film)
            <li class="list-group-item"> {{$film->title}}</li>
        @endforeach
    </ul>
    @endif
  </div>
@endsection
