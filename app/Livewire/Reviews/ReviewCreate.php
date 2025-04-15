<?php

namespace App\Livewire\Reviews;

use Livewire\Component;

class ReviewCreate extends Component
{
    public $recipe_id;
    public $title = '';
    public $review = '';
    public $user_id = 0;


    public function mount(string $recipe_id)
    {
        $this->recipe_id = $recipe_id;
    }

    /**
     * Validate the input values submitted  via the form
     *
     * @return boolean - true or false if the values are validated
     */
    public function validateReview()
    {
        return true;
    }


    /**
     * Create a review
     *
     * Validate the user input first
     * If validation fails, dispatch event to show alert and close the modal
     * If validation is successful, store values in the database
     *
     * @return void
     */
    public function store()
    {
        return true;
    }

    public function render()
    {
        return view('livewire.interactive.review-create');
    }
}
