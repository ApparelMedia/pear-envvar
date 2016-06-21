@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Project {{ $project->name }}</h4>
        </div>
    </div>
    <div class="row">
        @if ($inDraft)
            THIS IS A SAVED DRAFT
        @endif
    </div>
    <div class="row">
        <table>
            <thead>
            <th>Key</th>
            <th>Value</th>
            </thead>
            <tbody>
            @foreach($variables as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td><code>{{ $value }}</code></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <a class="button button-primary" href="{{url('envvars/' . $connection->id . '/edit')}}">
            @if ($inDraft)
            Edit Draft Variables
            @else
            Start a Draft to Edit
            @endif
        </a>
    </div>
@stop
