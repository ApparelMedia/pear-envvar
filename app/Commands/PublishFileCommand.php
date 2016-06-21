<?php namespace App\Commands;

use App\Removers\LocalDraftFileRemover;
use App\Writers\LocalEnvVarBackupWriter;
use App\Writers\LocalEnvVarDraftWriter;
use App\Writers\LocalEnvVarPublishWriter;
use App\Removers\RemoteDraftFileRemover;
use App\Writers\RemoteEnvVarBackupWriter;
use App\Writers\RemoteEnvVarDraftWriter;
use App\Writers\RemoteEnvVarPublishWriter;
use Illuminate\Database\Eloquent\Collection;

class PublishFileCommand implements CommandInterface {
    /**
     * PublishFileCommand constructor.
     * @param $project
     * @param $variables
     * @param Collection $connections
     */
    public function __construct($project, $variables, array $connections)
    {
        $this->project = $project;
        $this->variables = $variables;
        $this->connections = $connections;
    }

    public function execute()
    {
        foreach($this->connections as $connection) {
            $draftPath = $connection->draft_path;
            $prodPath = $connection->prod_path;
            $backupPath = $connection->backup_path;
            $stagingPath = $connection->staging_path;

            if ($connection->is_local) {
                $draftWriter = new LocalEnvVarDraftWriter($draftPath, $this->variables);
                $backupWriter = new LocalEnvVarBackupWriter($prodPath, $backupPath);
                $prodWriter = new LocalEnvVarPublishWriter($prodPath, $draftWriter, $backupWriter);
                $draftRemover = new LocalDraftFileRemover($draftPath);
            } else {
                $session = $connection->getSshSession();
                $draftWriter = new RemoteEnvVarDraftWriter($draftPath, $this->variables, $session);
                $backupWriter = new RemoteEnvVarBackupWriter($stagingPath, $backupPath, $session);
                $prodWriter = new RemoteEnvVarPublishWriter($stagingPath, $draftWriter, $backupWriter, $session);
                $draftRemover = new RemoteDraftFileRemover($draftPath, $session);
            }
            $prodWriter->writeFile();
            $draftRemover->removeFile();
        }
        return true;
    }

    protected function createPublishWriter()
    {
        //TODO return publishWriter
    }
}