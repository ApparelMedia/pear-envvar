@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Projects</h4>
        </div>
    </div>
    @foreach($connections as $connection)
        <div class="row">
            <a href="{{url('/connections/' . $connection->id)}}">{{$connection->project->name}} Connection - {{$connection->host}}</a>
        </div>
    @endforeach
@stop
