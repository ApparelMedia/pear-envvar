<?php namespace App\Loaders;

class DotEnvLocalFileLoader extends AbstractVariableFileLoader
{
    function __construct($path)
    {
        $this->path = $path;
    }

    protected function readFile()
    {
        // Read file into an array of lines with auto-detected line endings
        $autodetect = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', '1');
        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ini_set('auto_detect_line_endings', $autodetect);
        return $lines;
    }
}