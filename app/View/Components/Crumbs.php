<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Crumbs extends Component
{
    /**
     * crumbs type.
     *
     * @var array
     */
    public $crumbs;

    /**
     * Create a new component instance.
     *
     * @param  array  $crumbs
     */
    public function __construct($crumbs = [])
    {
        $this->crumbs = $crumbs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.crumbs');
    }
}
