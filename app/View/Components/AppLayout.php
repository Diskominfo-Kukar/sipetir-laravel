<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Title Type.
     *
     * @var string|null
     */
    public $title;

    /**
     * subTitle Type.
     *
     * @var string|null
     */
    public $subTitle;

    /**
     * crumbs type.
     *
     * @var array
     */
    public $crumbs;

    /**
     * icon type.
     *
     * @var string
     */
    public $icon;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @param  string  $subTitle
     * @param  array  $crumbs
     * @param  string  $icon
     */
    public function __construct($title = null, $subTitle = null, $crumbs = [], $icon = null)
    {
        $this->title    = $title;
        $this->subTitle = $subTitle;
        $this->crumbs   = $crumbs;
        $this->icon     = $icon;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
