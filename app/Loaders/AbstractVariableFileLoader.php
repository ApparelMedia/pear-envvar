<?php namespace App\Loaders;

abstract class AbstractVariableFileLoader {
    abstract protected function readFile();

    public function getVariables()
    {
        $lines = $this->readFile($this->path);
        $array = [];
        foreach ($lines as $line) {
            if (!$this->isComment($line) && $this->looksLikeSetter($line)) {
                list($key, $value) = $this->splitCompoundStringIntoParts($line);
                $array[$key] = $value;
            }
        }
        return $array;
    }

    protected function isComment($line)
    {
        return strpos(ltrim($line), '#') === 0;
    }

    protected function looksLikeSetter($line)
    {
        return strpos($line, '=') !== false;
    }

    protected function splitCompoundStringIntoParts($line)
    {
        if (strpos($line, '=') !== false) {
            list($key, $value) = array_map('trim', explode('=', $line, 2));
        }
        return array($key, $value);
    }
}
