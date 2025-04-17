<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'user_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class);
    }
    public function comments()
{
    return $this->hasMany(\App\Models\Comment::class);
}

}
