<?php namespace App\Writers;

class LocalEnvVarBackupWriter implements WriterInterface
{
    function __construct($fromPath, $toPath)
    {
        $this->fromPath = $fromPath;
        $this->toPath = $toPath;
    }

    public function writeFile()
    {
        $success = app('files')->copy($this->fromPath, $this->toPath);
        return $success;
    }

    public function getTargetName()
    {
        return $this->toPath;
    }
}