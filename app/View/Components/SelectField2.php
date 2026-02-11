<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SelectField2 extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $label;
    public Collection|array $options;
    public string $value;
    public bool $required;
    public bool $edit;
    public string $textField;
    public string $valueField;
 

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-field2');
    }
}
