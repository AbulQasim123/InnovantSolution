<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDropDownView extends Component
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
    public function render(): View|Closure|string
    {
        return view('components.action-drop-down-view');
    }
}
