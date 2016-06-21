<?php namespace App\Commands;

use \App\Removers\RemoteDraftFileRemover;
use \App\Removers\LocalDraftFileRemover;

class DiscardDraftCommand implements CommandInterface {
    public function __construct($connections)
    {
        $this->connections = $connections;
    }

    public function execute() {
        foreach($this->connections as $connection) {
            $path = $connection->draft_path;
            if ($connection->is_local) {
                $draftRemover = new LocalDraftFileRemover($path);
            } else {
                $session = $connection->getSshSession();
                $draftRemover = new RemoteDraftFileRemover($path, $session);
            }
            
            $draftRemover->removeFile();
        }

    }
}