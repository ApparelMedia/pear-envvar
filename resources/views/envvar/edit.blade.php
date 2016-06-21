@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Project {{ $project->name }} - Edit</h4>

        </div>
    </div>
    <form action="/envvars/{{ $orgConnection->id }}" method="POST" id="envvar-form">

        @if($inDraft)
            <h5>{{$project->dotenv_draft}} Values - This is a saved draft</h5>
        @else
            <h5>.env Values</h5>
        @endif
    <div class="row">
        <div class="four columns">Key</div>
        <div class="six columns">Value</div>
        <div class="two columns">actions</div>
    </div>
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="envvar-container">
        @foreach($variables as $key => $value)
            <div class="row variable envvar-row">
                <div class="four columns"><input type="text" class="code-input" name="variables[key][]" value="{{ $key  }}"></div>
                <div class="six columns"><input type="text" class="code-input" value="{{ $value }}" name="variables[value][]"></div>
                <div class="two columns"><a href="#" class="button close remove-row"><i class="fa fa-times-circle"></i></a></div>
            </div>
        @endforeach
        </div>
        <div class="row">
            <button class="u-pull-right" id="add-row">Add Data</button>
        </div>
        <h5>Destinations</h5>
        <div class="connections-container">
            @foreach($project->connections as $connection)
                <div class="row">
                    <input type="checkbox" class="connection" name="connections[]" id="connection_{{$connection->id}}"
                           @if ($orgConnection->id === $connection->id)
                           checked
                           @endif
                           value="{{$connection->id}}">
                    <label style="display: inline" for="connection_{{$connection->id}}">{{ $connection->host }} <i id="connection_icon_{{$connection->id}}" class="fa fa-circle icon-bg-gray"></i></label>
                </div>
            @endforeach
        </div>
        <div class="row">
            @if ($inDraft)
            <div class="three columns"><button type="submit" name="action_discard" value="save">Discard Draft</button></div>
            @endif
            <div class="three columns"><button type="submit" name="action_save" value="save">Save Draft</button></div>
            <div class="three columns"><button type="submit" name="action_publish" value="publish">Publish!</button></div>
        </div>
    </form>
@stop

@section('script')
@stop
