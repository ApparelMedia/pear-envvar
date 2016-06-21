@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Project {{ $project->name }}</h4>

        </div>
    </div>
    <div class="row">
        <p>Name: {{$project->name}}</p>
        <p>.env Path: {{$project->dotenv_path}}</p>
        <p>Active: @if($project->active) true @else false @endif</p>
    </div>
    <div class="row">
        <h5>Connections</h5>
        @foreach($project->connections as $connection)
            <a class="button" href="/connections/{{$connection->id}}">{{$connection->host}}</a>
        @endforeach
        <a href="{{url('connections/create?project-id=' . $project->id)}}" class="button button-primary">Create a new Connection</a>
    </div>
@stop
