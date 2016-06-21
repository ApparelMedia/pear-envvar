<?php namespace App\Removers;

class LocalDraftFileRemover implements RemoverInterface
{
    function __construct($draftPath)
    {
        $this->draftPath = $draftPath;
    }

    public function removeFile()
    {
        return app('files')->delete($this->draftPath);
    }
}