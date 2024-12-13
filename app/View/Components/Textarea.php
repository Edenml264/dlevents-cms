<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $value;
    public $attributes;

    public function __construct($name = '', $value = '', $attributes = [])
    {
        $this->name = $name;
        $this->value = $value;
        $this->attributes = $attributes;
    }

    public function render()
    {
        return view('components.textarea');
    }
}
