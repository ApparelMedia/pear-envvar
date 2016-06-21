<?php namespace App\Writers;

use Illuminate\Database\Query\Expression;

class LocalEnvVarPublishWriter implements WriterInterface
{
    function __construct($path, WriterInterface $draftWriter, WriterInterface $backupWriter)
    {
        $this->prodPath = $path;
        $this->draftWriter = $draftWriter;
        $this->backupWriter = $backupWriter;
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
            throw \Exception('Backup file was not created.  Please make sure you have content in the prod environment variable file');
        }

        $success = app('files')->copy($fromPath, $this->prodPath);
        
        return $success;
    }

    public function getTargetName()
    {
        // TODO: Implement getTargetName() method.
    }
}