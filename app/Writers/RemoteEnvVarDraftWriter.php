<?php namespace App\Writers;

use App\Connection;
use Ssh\Session;

class RemoteEnvVarDraftWriter implements WriterInterface
{
    function __construct($path, $variables, Session $session)
    {
        $this->variables = $variables;
        $this->path = $path;
        $this->session = $session;
    }

    public function writeFile()
    {
        $content = $this->getContent();
        $path = substr($this->path, 1);

        return (bool) $this->session->getSftp()->write($path, $content);
    }

    protected function getContent()
    {
        $content = "#### This file is written by EnvVar App ####\n";
        foreach ($this->variables as $key => $value) {
            $content .= $key . '='. $value . "\n";
        }
        return $content;
    }


    public function getTargetName()
    {
        return $this->path;
    }
}