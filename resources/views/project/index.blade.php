@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Projects</h4>
        </div>
    </div>
    @foreach($projects as $project)
        <div class="row">
            <a href="{{url('/projects/' . $project->id)}}">{{$project->name}}</a>
        </div>
    @endforeach
@stop
