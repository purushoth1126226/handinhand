<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;

class admincreateoreditnav extends Component
{
    public $name;
    public $title;
    public $obj;
    public $backbutton;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $obj, $backbutton)
    {
        $this->name  = $name;
        $this->title = $title;
        $this->obj   = $obj;
        $this->backbutton   = $backbutton;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.layouts.admincreateoreditnav');
    }
}
