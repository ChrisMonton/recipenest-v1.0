<?php

namespace App\View\Components\Additional\Tinymce;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Key extends Component
{
    public $key;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->key = env('TINYMCE_KEY');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.additional.tinymce.key');
    }
}
