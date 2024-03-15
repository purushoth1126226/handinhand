<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;

class adminshownav extends Component
{
    public $name;
    public $title;
    public $backbutton;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title,$backbutton)
    {
        $this->name  = $name;
        $this->title = $title;
        $this->backbutton   = $backbutton;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.layouts.adminshownav');
    }
}
