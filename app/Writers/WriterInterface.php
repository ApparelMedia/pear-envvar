<?php namespace App\Writers;

interface WriterInterface
{
    public function writeFile();
    public function getTargetName();
}