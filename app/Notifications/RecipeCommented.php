<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\User;

class RecipeCommented extends Notification
{
    use Queueable;

    protected $commenter;
    protected $recipe;
    protected $comment;

    public function __construct(User $commenter, Recipe $recipe, Comment $comment)
    {
        $this->commenter = $commenter;
        $this->recipe    = $recipe;
        $this->comment   = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message'    => "{$this->commenter->first_name} commented on your recipe “{$this->recipe->title}”",
            'recipe_id'  => $this->recipe->id,
            'comment_id' => $this->comment->id,
            'comment'    => $this->comment->body,
            'commenter'  => $this->commenter->id,
        ];
    }
}
