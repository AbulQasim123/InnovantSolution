<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDropdown extends Component
{
    public $editRoute;
    public $editId;
    public $deleteMethod;
    public $confirmMessage;
    public function __construct($editRoute, $editId, $deleteMethod = 'delete', $confirmMessage = 'Are you sure?')
    {
        $this->editRoute = $editRoute;
        $this->editId = $editId;
        $this->deleteMethod = $deleteMethod;
        $this->confirmMessage = $confirmMessage;
    }

    public function render()
    {
        return view('components.action-dropdown');
    }
}
