<?php

namespace App\Http\Controllers;

use App\Checkers\ConnectionInDraftChecker;
use App\Connection;
use App\Loaders\DotEnvLocalFileLoader;
use App\Loaders\DotEnvRemoteFileLoader;
use App\Loaders\FileLoaderFactory;
use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class EnvvarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $connection = Connection::find($id);
        $project = $connection->project;
        $inDraft = (new ConnectionInDraftChecker($connection))->check();

        $loader = (new FileLoaderFactory($connection, new ConnectionInDraftChecker($connection)))->make();

        $variables = $loader->getVariables();

        return view('envvar.view', compact('project', 'variables', 'connection', 'inDraft'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orgConnection = Connection::find($id);
        $project = $orgConnection->project;
        $inDraft = (new ConnectionInDraftChecker($orgConnection))->check();

        $loader = (new FileLoaderFactory($orgConnection, new ConnectionInDraftChecker($orgConnection)))->make();
        $variables = $loader->getVariables();

        return view('envvar.edit', compact('project', 'variables', 'orgConnection', 'inDraft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $orgConnection = \App\Connection::find($id);
        $project = $orgConnection->project;
        $variables = (new \App\Processors\InputToVariableArray($request))->getResults();
        $connections = [];

        foreach($request->get('connections') as $connectionId) {
            $connections[] = Connection::find($connectionId);
        }

        if ($request->has('action_save')) {
            (new \App\Commands\SaveDraftCommand($project, $variables, $connections))->execute();
        } elseif ($request->has('action_publish')) {
            (new \App\Commands\PublishFileCommand($project, $variables, $connections))->execute();
        } elseif ($request->has('action_discard')) {
            (new \App\Commands\DiscardDraftCommand($connections))->execute();
        }

        return redirect('envvars/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
