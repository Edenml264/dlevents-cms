<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $text;

    public function __construct($type = 'button', $class = '', $text = '')
    {
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
    }

    public function render()
    {
        return view('components.button');
    }
}
