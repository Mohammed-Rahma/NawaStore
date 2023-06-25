<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShopLayout extends Component
{
    public $title;
    public $showBreadCrumb;
    /**
     * Create a new component instance.
     */
    public function __construct($title , $showBreadCrumb =true ) 
    {
        $this->title = $title;
        $this->showBreadCrumb=$showBreadCrumb;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('layouts.shope');


        // return view('layouts.shope' , [
        //     'title' => $this->title,
        // ]);
    }
}
