<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;

class adminindexnav extends Component
{
    public $name;
    public $title;
    public $button;
    public $gate;
    public $can;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $button, $gate, $can)
    {
        $this->name = $name;
        $this->title = $title;
        $this->button = $button;
        $this->gate = $gate;
        $this->can = $can;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.layouts.adminindexnav');
    }
}
