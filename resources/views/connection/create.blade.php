@extends('master')

@section('content')
    <div class="row">
        <div class="column">
            <h4>Create a Connection</h4>
        </div>
    </div>
    <form action="/connections" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="column">
                <input type="checkbox" id="is_local" name="is_local" >
                <label for="is_local" style="display:inline">Is Local</label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <input type="checkbox" checked id="enabled" name="enabled" >
                <label for="enabled" style="display:inline">Is Enabled</label>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <label for="project_id">Project</label>
                <select name="project_id" id="project_id">
                    @foreach($projects as $projectName => $projectId)
                        @if( $requestedProjectId === $projectId)
                            <option selected value="{{$projectId}}">{{$projectName}}</option>
                        @else
                            <option value="{{$projectId}}">{{$projectName}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="host">Host</label>
                <input type="text" name="host" id="host" placeholder="localhost">
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="project_path">Path to Project on Target Server</label>
                <input style="width: 100%;" type="text" name="project_path" id="project_path" placeholder="/home/vagrant/www/my-project">
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="ssh_config_path">Path to SSH Config on Local Machine</label>
                <input style="width: 100%;" type="text" name="ssh_config_path" id="ssh_config_path" placeholder="/home/vagrant/.ssh/config">
            </div>
        </div>
        <button type="submit">Create Project</button>
    </form>

@stop