<?php

namespace App\View\Components\Template\Menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;
    public $icon;
    public $title;
    public $active;
    public function __construct($url, $title, $icon)
    {
        $this->title = $title;
        $this->url = $url;
        $this->icon = $icon;
        $this->active = $this->checkActive();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function checkActive()
    {
        $state = true;
        $url = $this->url;
        $arr_url = explode('/', $url);
        foreach ($arr_url as $key => $value) {
            $segment = request()->segment($key + 1);
            if ($segment != $value) $state = false;
        }
        return $state;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.template.menu.menu-item');
    }
}
