<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SelectField extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $label;
    public Collection|array $options;
    public bool $required;
    public bool $edit;
    public string $textField;
    public string $valueField;
    public function __construct(string $name, string $label,  $options = [], bool $required = false, bool $edit,  string $valueField = 'id', string $textField = 'name')
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = collect($options);
        $this->required = $required;
        $this->edit = $edit;
        $this->textField = $textField;
        $this->valueField = $valueField;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-field');
    }
}
