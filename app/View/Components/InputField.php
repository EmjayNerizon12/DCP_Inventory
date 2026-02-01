<?php

namespace App\View\Components;

use Closure;
use GuzzleHttp\Promise\Is;
use Hamcrest\Type\IsBoolean;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public string $type;
    public string $label;
    public string $name;
    public bool $required;
    public bool $edit;
    public function __construct(string $type, string $label, string $name, bool $required, bool $edit)
    {
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->edit = $edit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
