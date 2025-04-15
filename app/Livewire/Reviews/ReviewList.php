<?php

namespace App\Livewire\Reviews;

use App\Models\User;
use App\Models\Review;
use App\Models\Recipe;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ReviewList extends Component
{
    use WithPagination;
    use WithoutUrlPagination;


    public $recipe;
    public $chef;


    /**
     * Constructor for creating a review list
     *
     * Render a list of reviews by users
     *
     * @param Writing $recipe - Writing model
     * @param User $chef - Author model
     * @return void
     */
    public function mount(Recipe $recipe, User $chef)
    {
        $this->recipe = $recipe;
        $this->chef = $chef;
        $this->index();
    }


    #[On('review-list')]
    public function index()
    {
        return true;
    }


    /**
     * Delete a review
     *
     * Using livewire components, listen for an event 'review-destroy'
     * If a review is deleted, refresh list of reviews and alerts
     * If unsuccessful, show alert
     *
     */
    #[On('review-destroy')]
    public function destroy(string $id)
    {
        return true;
    }


    public function render()
    {
        // return view('livewire.interactive.review-list');

        // Pass data to the view
        return view('livewire.reviews.review-list', [
         'review_data' => Review::list($this->writing->id)->paginate(3),
            ]);
    }
}
