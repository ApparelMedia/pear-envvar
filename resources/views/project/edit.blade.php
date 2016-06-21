@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Project {{ $project->name }} - Edit</h4>

        </div>
    </div>
    <div class="row">
        <div class="two columns">Key</div>
        <div class="eight columns">Value</div>
        <div class="two columns">actions</div>
    </div>
    <form action="" method="POST">
        @foreach($variables as $key => $value)
            <div class="row" style="padding: 10px 0;">
                <div class="two columns">{{ $key }}</div>
                <div class="eight columns"><input style="margin-bottom: 0; width: 100%; font-family: monospace;" type="text" value="{{ $value }}" name="KEY_{{$key}}"></div>
                <div class="two columns"><div class="close"><i class="fa fa-times-circle"></i></div></div>
            </div>
        @endforeach
        <div class="row">
            <div class="four columns"><button type="submit" name="action_save" value="save">Save Draft</button></div>
            <div class="fourcolum"><button type="submit" name="action_publish" value="publish">Save & Publish</button></div>
        </div>
    </form>
@stop
