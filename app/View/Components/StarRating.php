<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StarRating extends Component
{
    /**
     * Create a new component instance.
     * check the link below:
     * https://laravel.com/docs/10.x/blade#components
     * Or:
     * Project3:Lecture:63
     */
    
    // we can pass parameters to the compnent to carry specific value represent the componenet functionality

    public function __construct(
        public readonly float $rating
        ) 
    // the readonly way is a new version of php to define a field in a class

    
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    // it's similar to which running in the controller so we don't have to pass any data here cause it get it from the contrctor
    public function render(): View|Closure|string
    {
        return view('components.star-rating');
    }
}
