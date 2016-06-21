@extends('master')

@section('content')
    <div class="row">
        <h1>Welcome!</h1>
    </div>
    <div class="row">
        <h3>Getting Started</h3>
    </div>
    <div class="row">
        <ol>
            <li>
                <p>Please edit your <code>~/.ssh/config</code> file in the machine that you are using to access the application. (typically, it would be your VM)</p>
                <p>Don't forget to include <code>User</code> and <code>IdentityFile</code> property in the config.  This config file is all this app uses to connect to your remote hosts</p>
        <pre><code>
Host something.example
    HostName something01.vpc123.example.com
    User apache
    IdentityFile ~/.ssh/id_rsa
        </code></pre>
            </li>
            <li>
                <a class="button" href="{{url('projects/create')}}">Create a Project</a> <p> A Project is a code repo that serves a common purpose.  When creating the project, you'll just have to give it a name. </p>
            </li>
            <li>
                <a class="button" href="{{url('connections/create')}}">Create a Connection</a> <p>A Connection is the connection between a particular project to a particular host. </p>
                <p>There are two types of hosts - local or remote.  Local is your current VM that you are access this app.  Remote is a server that's listed in your <code>~/.ssh/config</code> file.</p>
                <p><code>Host</code> is the name that you give your server in your <code>~/.ssh/config</code> file.  If it's Local, please put <code>localhost</code></p>
                <p><code>Path to Project</code> is the absolute path to your project on the partcular host.</p>
                <p><code>Path to SSH Config</code> is the absolute path to your ssh config <b>on your current VM</b></p>
            </li>
        </ol>
    </div>
@stop