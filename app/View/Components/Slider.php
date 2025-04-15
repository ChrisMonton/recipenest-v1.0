<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Slider extends Component
{
    public int $items = 0;

    /**
     * Render a new slider
     *
     * @param Collection $collection - collection of data
     * @param string $id - html id
     * @param string $title - title of slider
     * @param integer $items - number of items to show per slider
     */
    public function __construct(
        public Collection $collection,
        public string $id = 'my-slider',
        public string $title = 'Slider',
        int $items = 0
    ) {
        // Provide items or calculate based on total collection count
        if (empty($items)) {
            $this->items = $collection->count() >= 3 ? 2 : 1;
        } else {
            $this->items = $items;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('pages.additional.slider');
    }
}
