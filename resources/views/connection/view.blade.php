@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Connection {{ $connection->host }} for {{ $connection->project->name }}</h4>

        </div>
    </div>
    <div class="row">
        <h5>Project Path</h5>
        <code>{{ $connection->project_path }}</code>
    </div>
    <div class="row">
        <br>
        <a class="button" href="{{url('envvars/' . $connection->id)}}">View Variables</a>
    </div>
    <div class="row">
    </div>
@stop
