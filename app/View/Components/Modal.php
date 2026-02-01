<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     */
    public string $id;
    public string $size;
    public string $type;
    public string $icon;
    public function __construct(string $id, string $size, string $type, string $icon)
    {
        $this->id = $id;
        $this->size = $size;
        $this->type = $type;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
