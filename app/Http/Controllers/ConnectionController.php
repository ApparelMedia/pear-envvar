<?php

namespace App\Http\Controllers;

use App\Connection;
use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $connections = Connection::all();
        return view('connection.index', compact('connections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all()->pluck('id', 'name')->toArray();
        $requestedProjectId = (int) request('project-id');
        return view('connection.create', compact('projects', 'requestedProjectId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $connection = new Connection();

        $connection->host = $request->get('host');

        if ($request->has('is_local')) {
            $connection->is_local = true;
            $connection->host = 'localhost';
        };

        if ($request->has('enabled')) {
            $connection->enabled = true;
        };
        $connection->project_id = $request->get('project_id');
        $connection->project_path = $request->get('project_path');
        $connection->ssh_config_path = $request->get('ssh_config_path', null);
        $connection->save();

        return redirect('/connections');
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
        return view('connection.view', compact('connection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
