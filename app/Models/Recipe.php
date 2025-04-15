<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;
    use Notifiable;

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'short_description',
        'full_description',
        'ingredients',
        'instructions',
        'image',
        'total_time',
        'total_time_unit',
        'publish_date',
        'featured',
    ];


    /**
     * Undocumented function
     *
     * @return void
     */
    public function getLink()
    {
        return route('recipes.show', ['id' => $this->id]);
    }


    // =============== RELATIONSHIPS ===============



    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'recipe_id');
    }


    // =============== SCOPES ===============


    public function scopeList(Builder $query)
    {
        $query->where('id', '>', 0)
        ->withReviewsCount()
        ->orderBy('publish_date', 'desc');
    }

    public function scopeRecipe(Builder $query, string $id)
    {
        $query->where('id', $id);
    }

    public function scopeForUser(Builder $query, int $id)
    {
        $query->where('user_id', $id);
    }


    public function scopeWithReviewsCount(Builder $query)
    {
        $query->withCount(['reviews as total_reviews']);
    }


    // =============== FUNCTIONS ===============

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getImage()
    {
        return asset('storage/'.$this->image);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function formatDate()
    {
        return Carbon::parse($this->publish_date)->format('Y-m-d');
    }



}
