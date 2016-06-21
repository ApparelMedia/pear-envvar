<?php namespace App\Processors;

use Illuminate\Http\Request;

class InputToVariableArray implements ProcessorInterface
{
    function __construct(Request $request) {
        $this->inputs = $request->input();
    }

    public function getResults()
    {
        $variables = [];
        foreach($this->inputs['variables']['key'] as $index => $keyValue) {
            $value = $this->inputs['variables']['value'][$index];
            $variables[$keyValue] = $value;
        }

        return $variables;
    }
}