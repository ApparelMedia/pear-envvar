<?php namespace App\Checkers;

use App\Connection;

class ConnectionSuccessfulChecker implements CheckerInterface
{
    function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    public function check() {
        if ($this->connection->is_local) {
            return true;
        }
        $fs = $this->connection->getSshSession()->getSftp();
        $project = $this->connection->project;
        $fileName = uniqid() . '.txt';
        $path = '/' . join_path($this->connection->project_path, $project->dotenv_path, $fileName);
        $fs->write($path, 'test');
        $text = $fs->read($path);
        $readSuccessful = ($text === 'test');
        $deleted = $fs->unlink($path);
        return ($readSuccessful and $deleted);
    }
}