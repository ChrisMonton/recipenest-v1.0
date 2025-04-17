<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Recipe;
use App\Models\User;

class RecipeLiked extends Notification
{
    use Queueable;

    protected $liker;
    protected $recipe;

    public function __construct(User $liker, Recipe $recipe)
    {
        $this->liker  = $liker;
        $this->recipe = $recipe;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message'   => "{$this->liker->first_name} liked your recipe “{$this->recipe->title}”",
            'recipe_id' => $this->recipe->id,
            'liker_id'  => $this->liker->id,
        ];
    }
}
