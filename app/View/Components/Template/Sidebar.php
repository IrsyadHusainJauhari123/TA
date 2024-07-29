<?php

namespace App\View\Components\Template;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $menu;
    public $title;
    public $header;
    public function __construct($menu = null, $header = null, $title = null)
    {
        $this->menu = $menu;
        $this->header = $header;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.template.sidebar');
    }
}
