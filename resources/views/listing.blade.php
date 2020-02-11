@extends('Layout/app')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong> Peoples</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="peoples" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Birth Year</th>
                                        <th>Eye Color</th>
                                        <th>Gender</th>
                                        <th>Hair Color</th>
                                        <!-- <th>Skin Color</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peoples as $people)
                                        <tr>
                                            <td><a href="listing/people/{{$people->people_id}}">{{$people->name}}</a></td>
                                            <td>{{$people->birth_year}}</td>
                                            <td>{{$people->eye_color}}</td>
                                            <td>{{$people->gender}}</td>
                                            <td>{{$people->hair_color}}</td>
                                            <!-- <td>{{$people->skin_color}}</td> -->

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Films</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="films" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <!-- <th>Opening Crawl</th> -->
                                        <th>Director</th>
                                        <th>Producer</th>
                                        <th>Release Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($films as $film)
                                        <tr>
                                            <td><a href="listing/film/{{$film->film_id}}">{{$film->title}}</a></td>
                                            <!-- <td>{{$film->opening_crawl}}</td> -->
                                            <td>{{$film->director}}</td>
                                            <td>{{$film->producer}}</td>
                                            <td>{{$film->release_date}}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
