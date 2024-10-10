<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{

    public $type, $model, $label, $name, $required, $disable;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'text', $model = null, $label = null, $name = null, $required = false, $disable = false)
    {
        $this->type = $type;
        $this->model = $model;
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->disable = $disable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
