<?php namespace App\Checkers;

use App\Connection;

class ConnectionInDraftChecker implements CheckerInterface
{
    function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    protected function checkLocal() {
        return \File::exists($this->connection->draft_path);
    }

    public function check() {
        if ($this->connection->is_local) {
            return $this->checkLocal();
        }
        $file = $this->connection->getSshSession()->getSftp();
        return $file->exists($this->connection->draft_path);
    }
}