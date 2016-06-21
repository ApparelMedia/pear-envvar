<?php namespace App\Loaders;

use Ssh\Session;

class DotEnvRemoteFileLoader extends AbstractVariableFileLoader
{
    /**
     * DotEnvRemoteFileLoader constructor.
     * @param $path
     * @param Session $session
     */
    function __construct($path, Session $session)
    {
        $this->path = $path;
        $this->session = $session;
    }

    protected function readFile()
    {
        // Read file into an array of lines with auto-detected line endings
        $fs = $this->session->getSftp();
        $path = $fs->getUrl($this->path);
        $autodetect = ini_get('auto_detect_line_endings');
        ini_set('auto_detect_line_endings', '1');
        if ( ! $fs->exists($this->path)) {
            $fs->write($this->path, '');
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        ini_set('auto_detect_line_endings', $autodetect);
        return $lines;
    }
}