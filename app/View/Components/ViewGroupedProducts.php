<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewGroupedProducts extends Component
{
    /**
     * Create a new component instance.
     */
    public $groups;
    public function __construct($groups)
    {
        $this->groups = $groups;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.view-grouped-products');
    }
}
