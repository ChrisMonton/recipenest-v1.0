<?php

namespace App\View\Components\Additional\Tinymce;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Config extends Component
{
    protected $editor;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id = 'my-tinymce-editor',
        string $editor
    ) {
        $this->editor = $editor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->editor == 'simple') {
            return view('components.additional.tinymce.config-simple');
        }
        return view('components.additional.tinymce.config');
    }
}
