<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;

class adminshowlabeldetails extends Component
{
    public $title;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $value)
    {
        $this->title  = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.layouts.adminshowlabeldetails');
    }
}