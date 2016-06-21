<?php namespace App\Writers;

class RemoteEnvVarBackupWriter implements WriterInterface
{
    function __construct($fromPath, $toPath, $session)
    {
        $this->fromPath = $fromPath;
        $this->toPath = $toPath;
        $this->session = $session;
    }

    public function writeFile()
    {
        try {
            $this->session->getExec()->run('cp '. $this->fromPath . ' ' . $this->toPath);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTargetName()
    {
        return $this->toPath;
    }
}