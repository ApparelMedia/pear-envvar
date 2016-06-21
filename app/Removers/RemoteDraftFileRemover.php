<?php namespace App\Removers;

use Ssh\Session;

class RemoteDraftFileRemover implements RemoverInterface
{
    function __construct($draftPath, Session $session)
    {
        $this->draftPath = $draftPath;
        $this->session = $session;
    }

    public function removeFile()
    {
        return $this->session->getSftp()->unlink($this->draftPath);
    }
}