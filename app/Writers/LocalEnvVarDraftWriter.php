<?php namespace App\Writers;

class LocalEnvVarDraftWriter implements WriterInterface
{
    function __construct($path, $variables)
    {
        $this->variables = $variables;
        $this->path = $path;
    }

    public function writeFile()
    {
        $content = "#### This file is written by EnvVar App ####\n";
        foreach ($this->variables as $key => $value) {
            $content .= $key . '='. $value . "\n";
        }
        $bytesWritten = app('files')->put($this->path, $content);
        return (bool) $bytesWritten;
    }

    public function getTargetName()
    {
        return $this->path;
    }
}