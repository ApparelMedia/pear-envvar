<?php

if (! function_exists('join_path')) {
    /**
     * Join Path
     */
    function join_path()
    {
        $args = func_get_args();
        $paths = array_map(function ($path) {
            return trim($path, '/');
        }, $args);
        $paths = array_filter($paths);
        return join('/', $paths);
    }
}
