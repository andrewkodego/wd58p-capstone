<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Module;

class MainMenu extends Component
{
    public function __construct(){

    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render() : View
    {
        $consoleMenus = Module::where('parent_module_id', 2)->orderby('sort_order','asc')->orderby('name','asc')->get();
        return view('components.main-menu', compact('consoleMenus'));
    }

    public function compose(View $view){
        $consoleMenus = Module::where('parent_module_id', 2)->orderby('sort_order','asc')->orderby('name','asc')->get();
        $view->with('consoleMenus', $consoleMenus);
    }
}
