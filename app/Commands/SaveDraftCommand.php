<?php namespace App\Commands;


class SaveDraftCommand implements CommandInterface {
    public function __construct($project, $variables, $connections)
    {
        $this->project = $project;
        $this->variables = $variables;
        $this->connections = $connections;
    }

    public function execute() {
        foreach($this->connections as $connection) {
            $path = $connection->draft_path;
            if ($connection->is_local) {
                $writer = new \App\Writers\LocalEnvVarDraftWriter($path, $this->variables);
            } else {
                $session = $connection->getSshSession();
                $writer = new \App\Writers\RemoteEnvVarDraftWriter($path, $this->variables, $session);
            }
            
            $writer->writeFile();
        }

    }
}