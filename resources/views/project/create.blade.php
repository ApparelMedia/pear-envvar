@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Create a Project</h4>
        </div>
    </div>
    <form action="/projects" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="column">
                <label for="name">Project Name (required)</label>
                <input type="text" id="name" name="name" >
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="column">--}}
                {{--<label for="path">.env file Path (default /)</label>--}}
                {{--<input type="text" id="path" name="path" placeholder="relative to project root" >--}}
            {{--</div>--}}
        {{--</div>--}}
        <button type="submit">Create Project</button>
    </form>
@stop
