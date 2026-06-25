<?php

namespace App\View\Components\front;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Safe\Exceptions\ApacheException;

class bodyheader extends Component
{
    /**
     * Create a new component instance.
     */
    public string $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front.bodyheader');
    }
}
