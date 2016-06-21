<?php namespace App\Loaders;

use App\Checkers\CheckerInterface;
use App\Connection;

class FileLoaderFactory
{
    function __construct(Connection $connection, CheckerInterface $draftChecker)
    {
        $this->connection = $connection;
        $this->inDraft= $draftChecker;
    }

    public function make() {
        $connection = $this->connection;
        $isLocal = $connection->is_local;

        if ($isLocal) {
            $path = $connection->prod_path;
        } else {
            $path = $connection->staging_path;
        }

        if ($this->inDraft->check()) {
            $path = $connection->draft_path;
        }

        if ($isLocal) {
            return new DotEnvLocalFileLoader($path);
        } else {
            return new DotEnvRemoteFileLoader($path, $connection->getSshSession());
        }
    }
}