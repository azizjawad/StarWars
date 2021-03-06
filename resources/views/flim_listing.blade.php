@extends('Layout/app')

@section('content')
<div class="col-md-6">
  <h3>Name - {{$film->title}}</h3>
    <hr><br>
    @if (count($peoples) > 0)
    <ul class="list-group">
        <h4>Characters</h4>
          @foreach($peoples as $people)
              <li class="list-group-item"> {{$people->name}}</li>
          @endforeach
    </ul>
    @endif
  </div>
@endsection
