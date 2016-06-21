<?php namespace App\Writers;

use Illuminate\Database\Query\Expression;
use Ssh\Session;

class RemoteEnvVarPublishWriter implements WriterInterface
{
    function __construct($path, WriterInterface $draftWriter, WriterInterface $backupWriter, Session $session)
    {
        $this->prodPath = $path;
        $this->draftWriter = $draftWriter;
        $this->backupWriter = $backupWriter;
        $this->session = $session;
    }

    public function writeFile()
    {
        $success = $this->draftWriter->writeFile();
        if (! $success) {
            throw \Exception('Draft file was not written.  Please make sure you have some data to write to file');
        }

        $fromPath = $this->draftWriter->getTargetName();

        $success = $this->backupWriter->writeFile();
        if (! $success) {
            throw new \Exception('Backup file was not created.  Please make sure you have content in the prod environment variable file');
        }

        $this->session->getExec()->run('cp '. $fromPath . ' ' . $this->prodPath);

        return $success;
    }

    public function getTargetName()
    {
        return $this->prodPath;
    }
}