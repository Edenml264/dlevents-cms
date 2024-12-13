<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $value;
    public $attributes;

    public function __construct($type = 'text', $name = '', $value = '', $attributes = [])
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->attributes = $attributes;
    }

    public function render()
    {
        return view('components.input');
    }
}
